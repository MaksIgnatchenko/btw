<?php

namespace App\Modules\Advert\DataTables;

use App\Modules\Advert\Enums\AdvertStatusEnum;
use App\Modules\Advert\Models\Advert;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AdvertDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'adverts.datatables_actions')
            ->editColumn('image', function (Advert $advert) {
                $imageUrl = url(Advert::IMAGE_URL . $advert->image);

                return "<img src='{$imageUrl}' alt='product image' width='100'>";
            })
            ->editColumn('status', function (Advert $advert) {
                if (AdvertStatusEnum::ACTIVE === $advert->status) {
                    return '<span class="text-green">Yes</span>';
                }

                return '<span class="text-red">No</span>';
            })
            ->rawColumns(['image', 'status', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Advert $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Advert $model)
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
            ->addAction(['width' => '80px'])
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
            'image' => [
                'orderable' => false,
            ],
            'name',
            'status' => ['title' => 'Active'],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'advertsdatatable_' . time();
    }
}
