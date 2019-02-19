<?php
/**
 * Created by PhpStorm.
 * User: meena
 * Date: 2/7/2019
 * Time: 10:40 PM
 */

namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{
    protected $request, $builder;
    protected $filters = [];

    /**
     * ThreadFilters constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // apply method to apply filters on qurey or builder (Builder $builder) :)
    public function apply($builder)
    {
        // assigning builder to class builder
        $this->builder = $builder;

        foreach($this->getFilters() as $filter => $value){

            if(method_exists($this, $filter)){
                $this->$filter($value);
            }
        }

        return $this->builder;

    }

    // return only filters we want nothing else from users itself
    public function getFilters()
    {
        return $this->request->only($this->filters);
    }


}