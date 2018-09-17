<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 22.11.2017
 */

namespace App\Modules\Users\DataTables;

use App\Helpers\DateConverter;
use App\Modules\Users\Models\Merchant;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class MerchantDataTable extends DataTable
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


        return $dataTable->addColumn('action', 'merchants.datatables_actions')
            ->editColumn('created_at', function (Merchant $merchant) {
                return DateConverter::date($merchant->created_at);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Merchant $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Merchant $model)
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
                'name'  => 'created_at',
                'data'  => 'created_at',
                'title' => 'Registered'
            ],
            [
                'name'  => 'business_name',
                'data'  => 'business_name',
                'title' => 'Business name'
            ],
            [
                'name'  => 'user.email',
                'data'  => 'user.email',
                'title' => 'Email'
            ],
            [
                'name'  => 'check',
                'data'  => 'check',
                'title' => 'Verified'
            ],
            [
                'name'  => 'status',
                'data'  => 'status',
                'title' => 'Status'
            ],
            [
                'name'  => 'user.username',
                'data'  => 'user.username',
                'title' => 'Username'
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
        return 'merchantsdatatable_' . time();
    }
}
