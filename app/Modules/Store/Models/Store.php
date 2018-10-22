<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 17.10.2018
 */

namespace App\Modules\Store\Models;

use App\Modules\Categories\Models\Category;
use App\Modules\Users\Merchant\Models\Merchant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Store extends Model
{
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
}
