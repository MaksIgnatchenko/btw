<?php
/**
 * Created by Andrei Podgornyi, Appus Studio LP on 08.10.2018
 */

namespace App\Modules\Users\Customer\DataTables;

use App\Helpers\DateConverter;
use App\Modules\Users\Customer\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as DataTablesBuilder;

class CustomerDataTable extends DataTable
{

    /**
     * Build DataTable class.
     *
     * @param mixed $query Result from query() method.
     * @return EloquentDataTable
     */
    public function dataTable($query): EloquentDataTable
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'customers.admin.datatables_actions')
            ->editColumn('created_at', function (Customer $customer) {
                return DateConverter::date($customer->created_at);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Customer $model
     * @return Builder
     */
    public function query(Customer $model): Builder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return DataTablesBuilder
     */
    public function html(): DataTablesBuilder
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
                'name' => 'email',
                'data' => 'email',
                'title' => 'Email'
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
