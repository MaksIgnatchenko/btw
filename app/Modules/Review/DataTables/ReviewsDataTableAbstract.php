<?php
/**
 * Created by Artem Petrov, Appus Studio LP on 27.12.2017
 */

namespace App\Modules\Review\DataTables;

use Yajra\DataTables\Services\DataTable;

class ReviewsDataTableAbstract extends DataTable
{
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
            ->parameters();
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
                'title' => 'Date'
            ],
            [
                'name'  => 'status',
                'data'  => 'status',
                'title' => 'Approved'
            ],
            [
                'name'  => 'review',
                'data'  => 'review',
                'title' => 'Review'
            ],

        ];
    }
}
