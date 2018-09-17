<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 16.01.2018
 */

namespace App\Modules\Orders\DataTables;

use App\Helpers\DateConverter;
use App\Modules\Orders\Models\Outcome;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;
use \Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Services\DataTable;

class OutcomeDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'outcome.datatables_actions')
            ->editColumn('payment_date', function (Outcome $order) {
                return DateConverter::date($order->payment_date);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Outcome $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Outcome $model): Builder
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
        return 'outcome_reviewsdatatable_' . time();
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
                'dom'     => 'tp',
                'bInfo'   => false,
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
            'payment_date',
            'amount',
            'net_amount',
        ];
    }
}
