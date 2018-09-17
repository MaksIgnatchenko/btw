<?php

namespace App\Modules\Advert\DataTables;

use App\Helpers\DateConverter;
use App\Modules\WebOffers\Models\Log;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class LogDataTable extends DataTable
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

        $dataTable->editColumn('created_at', function (Log $log) {
            return DateConverter::date($log->created_at);
        });

        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Log $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Log $model)
    {
        return $model->newQuery();
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
            ->parameters([
                'dom'     => 'rtip',
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
            'created_at' => [
                'title' => 'Data',
            ],
            'message',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'logsdatatable_' . time();
    }
}
