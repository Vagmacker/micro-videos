<?php

namespace App\Services;

use App\Models\Genre;
use App\Repositories\Eloquent\GenreRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GenreService extends AbstractService
{
    public function __construct(public GenreRepository $repository)
    {
    }

    /**
     * Returns all registered genres in the system.
     */
    public function findAll(): Collection|array
    {
        return $this->repository->all();
    }

    /**
     * @param $attributes
     * @return Model|null
     * @throws Exception
     */
    public function save($attributes): Genre|null
    {
        $newGenre = null;

        try {
            $this->beginTransaction();

            $newGenre = $this->repository->create($attributes);

            $this->commit();
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }

        return $newGenre;
    }

    /**
     * Update a specific genre.
     *
     * @param $attributes
     * @param $genre
     * @return Collection|Genre
     * @throws Exception
     */
    public function update($attributes, $genre): Collection|Genre
    {
        $genreUpdated = null;

        try {
            $this->beginTransaction();

            $genreUpdated = $this->repository->updateById($genre->id, $attributes);

            $this->commit();
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }

        return $genreUpdated;
    }

    /**
     * Delete a genre.
     *
     * @param $genre
     * @throws Exception
     */
    public function delete($genre): void
    {
        try {
            $this->beginTransaction();

            $this->repository->deleteById($genre->id);

            $this->commit();
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }
    }
}
