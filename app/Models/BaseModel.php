<?php

namespace App\Models;

use App\QueryBuilders\BaseBuilder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 50;

    /**
     * The array fields to filter in search query.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * The custom builder class.
     *
     * @var object
     */
    protected $builder = BaseBuilder::class;

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        $builder = new $this->builder($query);
        $builder->setFilters($this->filters);

        return $builder;
    }
}
