<?php
/**
 * Created by Viacheslav Bilohlazov, Appus Studio LP on 18.02.2019
 */

namespace App\Modules\Reviews\Factories;

use Yajra\DataTables\Services\DataTable;

/**
 * Interface ReviewDataTableFactoryInterface
 * @package App\Modules\Reviews\Factories
 */
interface ReviewDataTableFactoryInterface
{
    /**
     * @param string $type
     * @return DataTable
     */
    public function getDataTableByType(string $type) : DataTable;
}
