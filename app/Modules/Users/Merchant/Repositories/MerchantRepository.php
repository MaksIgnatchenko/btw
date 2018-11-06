<?php

namespace App\Modules\Users\Merchant\Repositories;

use App\Modules\Users\Merchant\Models\Geography\GeographyCity;
use App\Modules\Users\Merchant\Models\Geography\GeographyCountry;
use App\Modules\Users\Merchant\Models\Geography\GeographyState;
use App\Modules\Users\Merchant\Models\Merchant;
use InfyOm\Generator\Common\BaseRepository;

class MerchantRepository extends BaseRepository
{
    /**
     * Configure the Model
     *
     * @return string
     */
    public function model(): string
    {
        return Merchant::class;
    }

    /**
     * @param array $data
     *
     * @return Merchant
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function createWithRelations(array $data): Merchant
    {
        $data['country'] = GeographyCountry::find($data['country'])->sortname;
        $data['state'] = GeographyState::find($data['state'])->name;
        $data['city'] = GeographyCity::find($data['city'])->name;

        /** @var Merchant $merchant */
        $merchant = $this->create(array_merge($data, [
            'phone' => $data['phone_code'] . $data['phone_number'],
        ]));

        $merchant->address()->create($data);

        $storeData = array_merge($data, [
            'country' => GeographyCountry::find($data['store_country'])->sortname,
            'city' => $data['store_city'],
            'name' => $data['store'],
        ]);

        $merchant->store()->create($storeData);

        return $merchant;
    }
}
