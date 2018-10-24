<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 19.10.2018
 */

namespace App\Modules\Users\Merchant\Helpers;

use App\Modules\Users\Merchant\Enums\GeographyObjectTypesEnum;
use App\Modules\Users\Merchant\Exceptions\UnknownGeographicObjectTypeException;
use App\Modules\Users\Merchant\Services\Geography\GeographyServiceInterface;
use Illuminate\Database\Eloquent\Collection;

abstract class GeographyHelper
{
    /**
     * @param int    $parentId
     * @param string $objectType
     *
     * @return Collection
     * @throws UnknownGeographicObjectTypeException
     */
    public static function getObjectsByParentId(int $parentId, string $objectType): Collection
    {
        $geographyService = app()[GeographyServiceInterface::class];

        switch ($objectType) {
            case GeographyObjectTypesEnum::STATE:
                return $geographyService->getStates($parentId);
            case GeographyObjectTypesEnum::CITY:
                return $geographyService->getCities($parentId);
            default:
                throw new UnknownGeographicObjectTypeException();
        }
    }

}