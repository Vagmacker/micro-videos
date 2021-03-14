<?php

namespace App\Repositories\Eloquent;


use App\Models\Category;
use App\Repositories\Abstract\EloquentAbstract;

class CategoryRepository extends EloquentAbstract
{
    /**
     * Set Model.
     *
     * {@inheritdoc}
     *
     * @see \App\Repositories\Abstract\EloquentAbstract::setModel()
     */
    public function model()
    {
        return Category::class;
    }
}
