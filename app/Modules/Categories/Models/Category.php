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
        'icon',
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
        'is_final' => 'boolean',
    ];

    /**
     * @param Collection $categories
     *
     * @return array
     */
    public function buildCategoriesTree(Collection $categories): array
    {
        return $this->buildTree($categories)[0] ?? [];
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
}
