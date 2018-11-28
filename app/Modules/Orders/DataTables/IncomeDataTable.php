<?php

namespace App\Modules\Orders\DataTables;

use App\Helpers\DateConverter;
use App\Modules\Orders\Enums\OrderStatusEnum;
use App\Modules\Orders\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class IncomeDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'income.datatables_actions')
            ->editColumn('picture', function (Order $order) {
                return "<img src='{$order->product->main_image_thumb}' alt='product image' height='75'>";
            })
            ->editColumn('name', function (Order $order) {
                return $order->product->name ?? '';
            })
            ->editColumn('status', function (Order $order) {
                $status = OrderStatusEnum::toArray()[$order->status];

                if (OrderStatusEnum::SHIPPED === $order->status) {
                    return "<span class='text-green'>{$status}</span>";
                }

                if (OrderStatusEnum::IN_PROCESS === $order->status) {
                    return "<span class='text-yellow'>{$status}</span>";
                }

                return "<span class='text-red'>{$status}</span>";
            })
            ->editColumn('created_at', function (Order $order) {
                return DateConverter::date($order->created_at);
            })
            ->rawColumns(['picture', 'action', 'status', 'amount']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Order $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model): Builder
    {
        return $model->newQuery()
            ->withAmount();
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'income_reviewsdatatable_' . time();
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
                    0, // here is the column number
                    'asc',
                ],
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
            'created_at' => [
                'title' => 'Purchase date',
            ],
            'amount' => [
                'title' => 'Amount',
                'searchable' => false,
            ],
            'picture' => [
                'name' => 'product',
                'title' => 'Picture',
                'orderable' => false,
            ],
            'name' => [
                'name' => 'product',
                'title' => 'Name',
            ],
            'status',
        ];
    }
}
