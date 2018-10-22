<div class="box box-default collapsed-box">
    <div class="box-header with-border">
        <h3 class="box-title">

            @if (!$category->is_final)
                <button type="button" class="btn btn-box-tool collapse-category" data-widget="collapse" data-toggle="tooltip" title=""
                        data-original-title="Collapse">
                    <i class="fa fa-plus"></i>
                </button>
            @endif
            {{$category->name}}
            @if ($category->is_final)
                <small class="disabled">(final)</small>
            @endif
        </h3>
        <div class="box-tools">

            @if (!$category->is_final)
                <a href='{!! route('categories.add-subcategory', ['id' => $category->id]); !!}'
                   class="btn btn-info" data-toggle="tooltip" title="Add subcategory">
                    <i class="fa fa-plus"></i>
                </a>
            @endif

            <a href='{!! route('categories.edit', ['id' => $category->id]); !!}' class="btn btn-primary">
                <i class="fa fa-pencil"></i>
            </a>
            @if(CategoriesHelper::canDelete($category))
                {!! Form::open(['route' => ['categories.delete', $category->id], 'method' => 'delete','class' => 'inline']) !!}
                <a href="#" class="btn btn-danger" onclick="deleteCategory(this)" data-toggle="tooltip"
                   title="Delete category">
                    <i class="fa fa-trash"></i>
                </a>
                {!! Form::close() !!}
            @else
                <span data-toggle="tooltip" title="Cannot delete category with products">
                    <a href='#' class="btn btn-danger disabled">
                        <i class="fa fa-trash"></i>
                    </a>
                </span>
            @endif

        </div>

    </div>
    @if (null !== $category->children)
        <div class="box-body">
            @each('categories.admin.categories', $category->children, 'category')
        </div>
    @endif

</div>