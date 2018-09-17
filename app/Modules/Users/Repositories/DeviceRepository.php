<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 15.12.2017
 */

namespace App\Modules\Users\Repositories;

use App\Modules\Users\Models\Device;
use InfyOm\Generator\Common\BaseRepository;

class DeviceRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Device::class;
    }

    /**
     * @param Device $device
     */
    public function save(Device $device): void
    {
        $device->save();
    }
}
