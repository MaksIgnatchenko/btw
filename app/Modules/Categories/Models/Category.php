<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 09.11.2017
 */

namespace App\Modules\Categories\Models;

use App\Modules\Categories\Exceptions\NotFountCategory;
use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Notifications\Models\PushCustomer;
use App\Modules\Products\Models\Product;
use App\Modules\Users\Models\Merchant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Log;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'is_final',
        'attributes',
        'parameters',
        'parent_category_id',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'attributes' => 'array',
        'parameters' => 'array',
        'is_final' => 'boolean',
    ];

    /** @var array */
    public $children = [];

    /**
     * @param Collection $categories
     *
     * @return array
     */
    public function buildCategoriesTree(Collection $categories): array
    {
        return $this->buildTree($categories)[0];
    }

    /**
     * @param int $categoryId
     *
     * @return Collection
     * @throws \App\Modules\Categories\Exceptions\NotFountCategory
     */
    public function getFinalCategories(int $categoryId): Collection
    {
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = app()[CategoryRepository::class];
        $currentCategory = $categoryRepository->find($categoryId);
        if ($currentCategory->is_final) {
            return new Collection([$currentCategory]);
        }

        $categories = $categoryRepository->all();

        $tree = $this->buildTree($categories);

        if (!isset($tree[$categoryId])) {
            Log::error("Can\'t find categories in tree for category id {$categoryId}");

            throw new NotFountCategory("Can\'t find categories in tree for category id {$categoryId}");
        }

        $result = $this->getCategoriesFromTree($tree[$categoryId]);

        return new Collection($result);
    }

    /**
     * @param array $categories
     *
     * @return array
     */
    private function getCategoriesFromTree(array $categories): array
    {
        $result = [];

        foreach ($categories as $category) {
            if ($category->children) {
                $recursionResult = $this->getCategoriesFromTree($category->children);
                $result += $recursionResult;
                continue;
            }
            $result[] = $category;
        }

        return $result;
    }

    /**
     * @param Collection $categories
     *
     * @return array
     */
    protected function buildTree(Collection $categories): array
    {
        $children = [];
        foreach ($categories as $category) {
            $parentCategoryId = $category->parent_category_id;
            if (null === $category->parent_category_id) {
                $parentCategoryId = 0;
            }
            $children[$parentCategoryId][] = $category;
        }

        foreach ($categories as $category) {
            if (isset($children[$category->id])) {
                $category->children = $children[$category->id];
            }
        }

        return $children;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function merchants(): BelongsToMany
    {
        return $this->belongsToMany(Merchant::class, 'category_merchant')
            ->withTimestamps()
            ->with('user');
    }

    /**
     * @return BelongsToMany
     */
    public function merchantsWhereEnabledWishList(): BelongsToMany
    {
        return $this->belongsToMany(Merchant::class, 'category_merchant')
            ->withTimestamps()
            ->with('user.device')
            ->whereHas('pushSettings', function ($query) {
                return $query->where([
                    'enabled' => true,
                    'wish_list' => true,
                ]);
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pushCustomers(): BelongsToMany
    {
        return $this
            ->belongsToMany(PushCustomer::class, 'push_customer_categories', 'category_id', 'push_customer_id')
            ->withTimestamps()
            ->with('customer');
    }

    /**
     * @return Collection
     */
    public function getProductsStatistic()
    {
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = app()[CategoryRepository::class];
        $rootCategories = $categoryRepository->findWhere(['parent_category_id' => null]);

        $productsStatistic = [];
        foreach ($rootCategories as $rootCategory) {
            try {
                $categories = $this->getFinalCategories($rootCategory->id)->load('products');

                $productsStatistic['count'][$rootCategory->name] = 0;
                foreach ($categories as $category) {
                    $productsStatistic['count'][$rootCategory->name] += $category->products->count();
                    $productsStatistic['name'][$rootCategory->name] = $rootCategory->name;
                }
            } catch (NotFountCategory $e) {
            }
        }

        return collect([
            'count' => collect($productsStatistic['count'])->values(),
            'name' => collect($productsStatistic['name'])->values(),
        ]);
    }
}
