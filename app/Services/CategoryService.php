<?php

namespace App\Services;

use App\Repositories\Eloquent\CategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryService extends AbstractService
{
    public function __construct(public CategoryRepository $repository)
    {

    }

    /**
     * Returns all registered categories in the system.
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
    public function save($attributes): Model|null
    {
        $newCategory = null;

        try {
            $this->beginTransaction();

            $newCategory = $this->repository->create($attributes);

            $this->commit();
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }

        return $newCategory;
    }

    /**
     * Update a specific category.
     *
     * @param $attributes
     * @param $categoru
     * @throws Exception
     */
    public function update($attributes, $categoru): void
    {
        try {
            $this->beginTransaction();

            $this->repository->updateById($categoru->id, $attributes);

            $this->commit();
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }
    }

    /**
     * Delete a category.
     *
     * @param $category
     * @throws Exception
     */
    public function delete($category): void
    {
        try {
            $this->beginTransaction();

            $this->repository->deleteById($category->id);

            $this->commit();
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }
    }
}
