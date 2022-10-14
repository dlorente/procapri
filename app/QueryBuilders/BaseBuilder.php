<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class BaseBuilder extends Builder
{
    protected $filters = [];

    protected $casts = [
        'id' => 'hash_db',
    ];

    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

    public function search()
    {
        return request()->search
            ? $this->whereLike($this->filters, request()->search)
            : $this;
    }

    public function active()
    {
        return $this->whereStatus(1);
    }

    public function whereLike($filters, $search)
    {
        $this->where(function ($query) use ($filters, $search) {
            foreach (array_wrap($filters) as $attribute) {
                $castSearch = $search;
                if ($castFunction = $this->casts[$attribute] ?? null) {
                    $castSearch = $castFunction($search);
                }

                $query->when(
                    str_contains($attribute, '.'),
                    $this->filterRelation($attribute, $castSearch),
                    $this->filter($attribute, $castSearch)
                );
            }
        });

        return $this;
    }

    private function filterRelation($attribute, $search)
    {
        return function ($query) use ($attribute, $search) {
            [$relation, $field] = explode('.', $attribute);

            $query->orWhereHas(
                $relation,
                fn ($query) => $query->where($field, 'LIKE', '%' . $search . '%')
            );
        };
    }

    private function filter($attribute, $search)
    {
        return fn ($query) => $query->orWhere($attribute, 'LIKE', '%' . $search . '%');
    }
}
