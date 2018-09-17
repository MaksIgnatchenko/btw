<?php

namespace App\Modules\Content\Repositories;

use App\Modules\Content\Models\Content;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContentRepository
 * @package App\Modules\Content\Repositories
 * @version November 17, 2017, 1:36 pm UTC
 *
 * @method Content findWithoutFail($id, $columns = ['*'])
 * @method Content find($id, $columns = ['*'])
 * @method Content first($columns = ['*'])
 */
class ContentRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Content::class;
    }

    /**
     * @param string $key
     *
     * @return Content|null
     */
    public function getContentByKey(string $key): ?Content
    {
        return Content::where('key', $key)->first();
    }
}
