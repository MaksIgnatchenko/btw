<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 20.11.2018
 */

namespace App\Modules\Users\Merchant\Http\Controllers\Web\Traits;

use App\Modules\Users\Merchant\Models\Merchant;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

trait MerchantImageUploader
{
    /**
     * @param UploadedFile $img
     * @param string       $path
     * @param string       $fieldName
     *
     * @return string
     */
    protected function uploadImage(UploadedFile $img, string $path, string $fieldName): string
    {
        $imgUrl = $img->store($path);

        /** @var Merchant $merchant */
        $merchant = Auth::user();

        $this->merchantRepository->update([
            $fieldName => $img->hashName(),
        ], $merchant->id);

        return $imgUrl;
    }

    /**
     * @param string $fieldName
     *
     * @return bool
     */
    protected function removeImage(string $fieldName): bool
    {
        /** @var Merchant $merchant */
        $merchant = Auth::user();

        $imgUrl = str_replace(Storage::url(''), null, $merchant->$fieldName);

        return Storage::delete($imgUrl);
    }
}
