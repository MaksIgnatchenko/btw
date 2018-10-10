<?php
/**
 * Created by Ilya Kobus, Appus Studio LP on 9.10.2018
 */

namespace App\Filters;

use App\Exceptions\WrongFilterNameException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class FilterAbstract implements FilterInterface
{
    /** @var array */
    protected $data;

    /** @var array */
    protected $filters;

    /**
     * FilterAbstract constructor.
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
     *
     * @return Builder|mixed
     */
    public function filter(Builder $builder)
    {
        foreach($this->data as $filter => $value)
        {
            $this->resolveFilter($filter)->filter($builder, $value);
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