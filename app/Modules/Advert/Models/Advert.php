<?php

namespace App\Modules\Advert\Models;

use App\Modules\Advert\Enums\AdvertStatusEnum;
use App\Modules\Advert\Repositories\AdvertRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    public const IMAGE_WIDTH = 320;
    public const IMAGE_HEIGHT = 50;

    public const IMAGE_URL = 'storage/images/adverts/origin/';
    public const IMAGE_STORE_PATH = 'public/images/adverts/origin';


    public $fillable = [
        'name',
        'link',
        'image',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'   => 'string',
        'link'   => 'string',
        'image'  => 'string',
        'status' => 'string',
    ];

    public function create(array $input): void
    {
        /** @var AdvertRepository $advertRepository */
        $advertRepository = app(AdvertRepository::class);
        $image = $input['image'];

        $image->store(self::IMAGE_STORE_PATH);

        $advertRepository->create(['image' => $image->hashName()] + $input);
    }

    /**
     * Get random advert
     *
     * @param string $mode
     *
     * @return Advert|null
     * @throws \InvalidArgumentException
     */
    public function get(string $mode): ?Advert
    {
        if (AdvertConfig::DEFAULT_MODE === $mode) {
            return null;
        }

        /** @var AdvertRepository $advertRepository */
        $advertRepository = app(AdvertRepository::class);
        /** @var Collection $adverts */
        $adverts = $advertRepository->findWhere(['status' => AdvertStatusEnum::ACTIVE]);

        if ($adverts->isEmpty()) {
            return null;
        }

        $advert = $adverts->random();

        return $advert->setVisible(['link', 'image']);
    }

    public function incrementCounter(): void
    {
        $this->counter++;
        /** @var AdvertRepository $advertRepository */
        $advertRepository = app(AdvertRepository::class);
        $advertRepository->save($this);
    }
}
