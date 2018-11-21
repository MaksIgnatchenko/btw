<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 20.11.2017
 */

namespace App\Modules\Categories\Http\Controllers\Admin;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Modules\Categories\Models\Category;
use App\Modules\Categories\Repositories\CategoryRepository;
use App\Modules\Categories\Requests\Admin\SaveRootCategoryRequest;
use App\Modules\Categories\Requests\Admin\SaveSubcategoryRequest;
use App\Modules\Categories\Requests\Admin\UpdateCategoryRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoriesController extends Controller
{
    /** @var CategoryRepository */
    protected $categoryRepository;
    /** @var Category */
    protected $categoryModel;

    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * CategoriesController constructor.
     *
     * @param CategoryRepository $categoriesRepository
     * @param Category           $categoryModel
     */
    public function __construct(
        CategoryRepository $categoriesRepository,
        Category $categoryModel
    )
    {
        $this->categoryRepository = $categoriesRepository;
        $this->categoryModel = $categoryModel;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(): View
    {
        $categories = $this->categoryRepository->all();
        $categoriesTree = $this->categoryModel->buildCategoriesTree($categories);

        return view('categories.admin.index')
            ->with('categories', $categoriesTree);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(): View
    {
        return view('categories.admin.add');
    }


    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|View
     */
    public function addSubcategory(int $id)
    {
        try {
            $category = $this->categoryRepository->find($id);
        } catch (\Exception $e) {
            Flash::error('Category not found');

            return redirect(route('categories.index'));
        }

        if ($category->is_final) {
            Flash::error('Category can\'t have subcategories');

            return redirect(route('categories.index'));
        }

        return view('categories.admin.add-subcategory', ['category' => $category]);
    }

    /**
     * @param SaveRootCategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function saveCategory(SaveRootCategoryRequest $request)
    {
        $categoryData = [
            'name' => $request->get('name'),
            'is_final' => false,
        ];

        if ($icon = $request->file('icon', null)) {
            $categoryData['icon'] = StorageHelper::upload($icon, 'category-icon/');
        }

        $this->categoryRepository->create($categoryData);

        Flash::success('Root category created successfully');

        return redirect(route('categories.index'));
    }

    /**
     * @param SaveSubcategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function saveSubcategory(SaveSubcategoryRequest $request)
    {
        $attributes = [
            'name'     => $request->get('name'),
            'is_final' => $request->get('is_final', false),

            'parent_category_id' => $request->get('parent_category_id'),
        ];

        if ($request->get('is_final')) {
            $attributes += [
                'attributes' => $this->attributesToArray($request->get('attributes', [])),
            ];
        }

        $this->categoryRepository->create($attributes);

        Flash::success('Subcategory created successfully');

        return redirect(route('categories.index'));
    }

    /**
     * @param $attributes
     *
     * @return array
     */
    protected function attributesToArray(array $attributes): array
    {
        $result = [];

        foreach($attributes as $attribute) {
            $attribute = json_decode($attribute);
            $result[] = [
                'name' => $attribute->name,
                'type' => $attribute->type,
            ];
        }

        return $result;
    }

    /**
     * @param int $id
     *
     * @return $this
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function edit(int $id)
    {
        $category = $this->checkCategory($id);

        return view('categories.admin.edit')
            ->with('category', $category);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UpdateCategoryRequest $request, int $id)
    {
        $category = $this->checkCategory($id);

        $attributes = [
            'name'     => $request->get('name'),
            'is_final' => $category->is_final,
        ];

        if ($icon = $request->file('icon', null)) {
            if (Storage::exists($category->getOriginal('icon'))) {
                Storage::delete($category->getOriginal('icon'));
            }
            $attributes['icon'] = StorageHelper::upload($icon, 'category-icon/');
        }

        if ($category->is_final) {
            $attributes += [
                'attributes' => $this->attributesToArray($request->get('attributes', [])),
            ];
        }

        $this->categoryRepository->update($attributes, $id);

        Flash::success('Category updated successfully');

        return redirect(route('categories.index'));
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function delete(int $id)
    {
        $category = $this->checkCategory($id);

        if (!$category->products->isEmpty()) {
            Flash::error('This category already has products or subcategories');

            return redirect(route('categories.index'));
        }

        $this->categoryRepository->delete($id);

        Flash::success('Category deleted successfully');

        return redirect(route('categories.index'));
    }

    /**
     * @param int $id
     *
     * @return Category
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function checkCategory(int $id): Category
    {
        $category = $this->categoryRepository->find($id);

        if (!$category) {
            throw new NotFoundHttpException();
        }

        return $category;
    }
}
