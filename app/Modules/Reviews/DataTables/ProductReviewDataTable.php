<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 18.02.2019
 */

namespace App\Modules\Reviews\DataTables;

use App\Helpers\DateConverter;
use App\Modules\Reviews\Enums\ReviewStatusEnum;
use App\Modules\Reviews\Models\ProductReview;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

/**
 * Class ProductReviewDataTable
 * @package App\Modules\Reviews\DataTables
 */
class ProductReviewDataTable extends DataTable
{
    /**
     * @param $query
     * @return DataTableAbstract
     */
    public function dataTable($query) : DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('customer_name', function (ProductReview $review) {
                return $review->order->customer->full_name;
            })
            ->addColumn('product_name', function (ProductReview $review) {
                return $review->order->product->name;
            })
            ->editColumn('status', function (ProductReview $review) {
                $status = ReviewStatusEnum::toArray()[$review->status];

                $class = ReviewStatusEnum::ACTIVE === $review->status
                    ? 'text-green'
                    : 'text-red';

                return "<span class='{$class}'>{$status}</span>";
            })
            ->editColumn('created_at', function (ProductReview $review) {
                return DateConverter::date($review->created_at);
            })
            ->addColumn('action', function (ProductReview $review) {
                return view('reviews.admin.datatables_actions', [
                    'type' => 'product',
                    'id' => $review->id,
                    ]);
            })
            ->rawColumns(['status', 'action',]);
    }

    /**
     * @param ProductReview $model
     * @return Builder
     */
    public function query(ProductReview $model): Builder
    {
        return $model->query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters([
                'dom' => 'tp<"#status-filter"><"payment-search"f>',
                'bInfo' => false,
                'order' => [
                    5, // here is the column number
                    'desc'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            'customer_name' => [
                'title' => 'Customer Name',
                'orderable' => false,
            ],
            'product_name' => [
                'title' => 'product Name',
                'orderable' => false,
            ],
            [
                'name' => 'rating',
                'data' => 'rating',
                'title' => 'Rating',
            ],
            [
                'name' => 'comment',
                'data' => 'comment',
                'title' => 'Comment',
            ],
            [
                'name' => 'status',
                'data' => 'status',
                'title' => 'Status',
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => 'Created At',
            ],
        ];
    }
}
