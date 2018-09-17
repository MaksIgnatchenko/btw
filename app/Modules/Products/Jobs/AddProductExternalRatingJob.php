<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 28.12.2017
 */

namespace App\Modules\Products\Jobs;

use App\Modules\Products\Exceptions\NoProductInAmazonException;
use App\Modules\Products\Exceptions\NoRatingInAmazonException;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Repositories\ProductRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use MarcL\AmazonAPI;
use MarcL\AmazonUrlBuilder;

class AddProductExternalRatingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;

    /**
     * AddProductExternalRating constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     * @throws \RuntimeException
     */
    public function handle(): void
    {
        $productName = $this->product->name;
        /** @var ProductRepository $productRepository */
        $productRepository = app(ProductRepository::class);

        try {
            $asin = $this->getAsin($productName);
            $rating = $this->getRating($asin);
        } catch (NoProductInAmazonException | NoRatingInAmazonException $e) {
            $rating = 0.0;
        }

        $this->product->rating = $rating;
        $productRepository->save($this->product);
    }

    /**
     * Getting product asin using amazon api
     * @param string $productName
     *
     * @return string
     * @throws NoProductInAmazonException
     */
    protected function getAsin(string $productName): string
    {
        $urlBuilder = new AmazonUrlBuilder(
            env('AWS_KEY'),
            env('AWS_SECRET_KEY'),
            env('AWS_ASSOCIATE_ID'),
            env('AWS_REGION')
        );

        $amazonAPI = new AmazonAPI($urlBuilder, 'simple');

        $items = $amazonAPI->ItemSearch($productName);

        if (!isset($items[0]['asin'])) {
            Log::debug("Not found product with name {$productName}");
            $items = print_r($items, true);
            Log::debug($items);

            throw new NoProductInAmazonException("Not found product with name {$productName}");
        }

        Log::debug('asin ' .  $items[0]['asin']);

        return $items[0]['asin'];
    }

    /**
     * Getting rating from amazon by asin using amazon widget
     *
     * @param string $asin
     *
     * @return float
     * @throws \RuntimeException
     * @throws \App\Modules\Products\Exceptions\NoRatingInAmazonException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function getRating(string $asin): float
    {
        $pattern = '/<span\s*class="a-size-base a-color-secondary"\s*>(?:\s|.)*?([0-9.]+)(?:\s|.)*?<\/span>/';
        $url = "https://www.amazon.com/gp/customer-reviews/widgets/average-customer-review/popover/ref=dpx_acr_pop_?contextId=dpx&asin={$asin}";

        $client = new Client();
        $request = new Request('GET', $url);
        $response = $client->send($request, ['timeout' => 2]);

        $content = $response->getBody()->getContents();

        preg_match($pattern, $content, $matches);

        if(!isset($matches[1])) {
            Log::debug("No rating for asin {$asin}");
            $matches = print_r($matches, true);
            Log::debug($matches);


            throw new NoRatingInAmazonException("No rating for asin {$asin}");
        }

        Log::debug('rating ' .  $matches[1]);

        return $matches[1];
    }
}
