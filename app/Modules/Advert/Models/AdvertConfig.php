<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 26.01.2018
 */

namespace App\Modules\Advert\Models;

use App\Modules\Advert\Repositories\AdvertConfigRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdvertConfig extends Model
{
    public const MODE = 'mode';
    public const CUSTOM_MODE = 'custom';
    public const ADMOB_MODE = 'admob';

    public const DEFAULT_MODE = 'admob';

    protected $primaryKey = 'key';
    protected $table = 'adverts_config';

    public $fillable = [
        'key',
        'value',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'key'   => 'string',
        'value' => 'string',
    ];

    /**
     * @return string
     */
    public function getMode(): string
    {
        /** @var AdvertConfigRepository $advertConfigRepository */
        $advertConfigRepository = app(AdvertConfigRepository::class);
        try {
            $config = $advertConfigRepository->find(self::MODE);
            $mode = $config->value;
        } catch (ModelNotFoundException $e) {
            $mode = self::DEFAULT_MODE;
        }

        return $mode;
    }
}
