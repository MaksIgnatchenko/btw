<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 08.02.2018
 */

namespace App\Modules\WebOffers\Models;

use App\Modules\WebOffers\Dto\ItemDto;
use App\Modules\WebOffers\Exceptions\ParserException;
use App\Modules\WebOffers\Helpers\GeneratorHelper;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class WebOffer extends Model
{
    protected const VGLINK_URL = 'https://rest.viglink.com/api/product/search';
    protected const ITEMS_LIMIT = 30;

    /**
     * @param string $name
     * @param string $upc
     * @param string|null $categoryName
     *
     * @return Collection
     * @throws ParserException
     */
    public function search(string $name, string $upc, string $categoryName = null): Collection
    {
        $client = new Client();
        $options = [
            'query' => [
                'apiKey' => env('VGLINK_API_KEY'),
                'query' => $name,
                'country' => 'us',
                'itemsPerPage' => 100,
                'upc' => $upc,
                'category' => $categoryName ?? '',
                //  Remove a limit for specific shops;
//                'merchant'     => [
//                    'care.com',
//                    'Care.com',
//                    'Zappos',
//                    'Macys.com',
//                    'Modells.com',
//                    'Nike',
//                    'restaurant.com',
//                    'Staples',
//                    'Target',
//                    'Groupon',
//                    'homedepot.com',
//                    'LivingSocial',
//                    'Lowes',
//                    'Amazon Marketplace',
//                    'Foot Locker',
//                    'Walmart',
//                    'walmart.com',
//                ]
            ],
            'headers' => [
                'Authorization' => 'secret ' . env('VGLINK_SECRET_KEY'),
            ],
        ];

        try {
            $response = $client->get(self::VGLINK_URL, $options);
        } catch (\Exception $e) {
            // TODO where should I move it?
            /** @var Log $log */
            $log = app(Log::class);
            $log->fill(['message' => $e->getMessage()]);
            $log->create();

            throw new ParserException($e->getMessage(), $e->getCode());
        }

        $json = json_decode($response->getBody()->getContents());

        $items = collect();

        foreach ($json->items as $item) {
            $rating = GeneratorHelper::generateWebOfferRating();

            $itemDto = new ItemDto();
            $itemDto->setImageUrl($item->imageUrl)
                ->setMerchant($item->merchant)
                ->setName($item->name)
                ->setPrice($item->price)
                ->setImageUrl($item->imageUrl)
                ->setUrl($item->url)
                ->setRating($rating);

            // Removed a limit for 1 item from 1 shop only;
            // $items[$item->merchant] = $itemDto->toArray();

            $items[] = $itemDto->toArray();

        }

        return $items->values()->forPage(1, self::ITEMS_LIMIT);
    }
}
