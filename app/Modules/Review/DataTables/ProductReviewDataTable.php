<?php

namespace App\Modules\Review\DataTables;

use App\Helpers\DateConverter;
use App\Modules\Review\Models\ProductReview;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;

class ProductReviewDataTable extends ReviewsDataTableAbstract
{
    /**
     * Get query source of dataTable.
     *
     * @param ProductReview $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProductReview $model): Builder
    {
        return $model->newQuery();
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'product_reviews.datatables_actions')
            ->editColumn('status', function (ProductReview $productReview) {
                if (ReviewStatusEnum::ACTIVE === $productReview->status) {
                    return '<span class="text-green">Yes</span>';
                }

                return '<span class="text-red">No</span>';
            })
            ->editColumn('created_at', function (ProductReview $productReview) {
                return DateConverter::date($productReview->created_at);
            })
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'product_reviewsdatatable_' . time();
    }
}
