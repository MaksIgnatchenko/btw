<?php

namespace App\Modules\Users\DataTables;

use App\Helpers\DateConverter;
use App\Modules\Users\Models\Customer;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class CustomerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'customers.datatables_actions')
            ->editColumn('created_at', function (Customer $merchant) {
                return DateConverter::date($merchant->created_at);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Customer $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())

            ->minifiedAjax()
            ->addAction(['width' => '80px'])
            ->parameters([
                'dom'     => 'frtip',
                'order'   => [[0, 'desc']],
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
            [
                'name' => 'first_name',
                'data' => 'first_name',
                'title' => 'First name'
            ],
            [
                'name' => 'last_name',
                'data' => 'last_name',
                'title' => 'Last name'
            ],
            [
                'name' => 'user.email',
                'data' => 'user.email',
                'title' => 'Email'
            ],
            [
                'name' => 'user.username',
                'data' => 'user.username',
                'title' => 'Username'
            ],
            [
                'name' => 'status',
                'data' => 'status',
                'title' => 'Status'
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => 'Registered'
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'customersdatatable_' . time();
    }
}
