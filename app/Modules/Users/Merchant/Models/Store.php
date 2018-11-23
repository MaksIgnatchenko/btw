<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Users\Merchant\Models;

use App\Modules\Categories\Models\Category;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Merchant\Helpers\GeographyHelper;
use App\Modules\Users\Merchant\Repositories\StoreRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    protected $fillable = [
         'name',
         'country',
         'city',
         'info',
         'merchant_id',
     ];

    /**
     * Company to merchant relation.
     *
     * @return BelongsTo
     */
    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * Store to categories relation.
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function updateStoreInfo(array $data): self
    {
        GeographyHelper::resolveGeographyNames($data);

        $storeRepository = app(StoreRepository::class);
        $storeRepository->update($data, $this->id);

        return $this;
    }
}
