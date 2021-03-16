<?php

namespace App\Repositories\Eloquent;

use App\Models\Genre;
use App\Repositories\Abstract\EloquentAbstract;

class GenreRepository extends EloquentAbstract
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
        return Genre::class;
    }
}
