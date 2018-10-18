<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 10.10.2018
 */

namespace App\Modules\Products\Filters;

use App\Exceptions\WrongFilterNameException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductFilter implements FilterInterface
{
    /** @var array */
    protected $data;

    /** @var array */
    protected $filters;

    /**
     * ProductFilter constructor.
     *
     * @param Request $request
     * @param array   $filters
     */
    public function __construct(array $data, array $filters)
    {
        $this->data = $data;
        $this->filters = $filters;
    }

    /**
     * @param Builder $builder
     * @param null    $value
     *
     * @return Builder
     * @throws WrongFilterNameException
     */
    public function filter(Builder $builder): Builder
    {
        foreach($this->data as $filter => $val)
        {
            $this->resolveFilter($filter)->filter($builder, $val);
        }
        return $builder;
    }

    /**
     * @param $filter
     *
     * @return mixed
     * @throws WrongFilterNameException
     */
    protected function resolveFilter($filter)
    {
        if(isset($this->filters[$filter])){
            return new $this->filters[$filter];
        }

        throw new WrongFilterNameException();
    }
}