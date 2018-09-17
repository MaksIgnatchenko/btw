<?php

namespace App\Modules\Review\DataTables;

use App\Helpers\DateConverter;
use App\Modules\Review\Models\MerchantReview;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;

class MerchantReviewDataTable extends ReviewsDataTableAbstract
{
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

        return $dataTable->addColumn('action', 'merchant_reviews.datatables_actions')
            ->editColumn('status', function (MerchantReview $merchantReview) {
                if (ReviewStatusEnum::ACTIVE === $merchantReview->status) {
                    return '<span class="text-green">Yes</span>';
                }

                return '<span class="text-red">No</span>';
            })
            ->editColumn('created_at', function (MerchantReview $merchantReview) {
                return DateConverter::date($merchantReview->created_at);
            })
            ->rawColumns(['status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param MerchantReview $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MerchantReview $model): Builder
    {
        return $model->newQuery();
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'merchant_reviewsdatatable_' . time();
    }
}
