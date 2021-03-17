<?php

namespace App\Services;

use App\Models\Video;
use App\Repositories\Eloquent\VideoRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class VideoService extends AbstractService
{
    public function __construct(public VideoRepository $repository)
    {
    }

    /**
     * Returns all registered videos in the system.
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
    public function save($attributes): Video|null
    {
        $newVideo = null;

        try {
            $this->beginTransaction();

            $newVideo = $this->repository->create($attributes);

            if (isset($attributes['genres_id'])) {
                $newVideo->genres()->sync($attributes['genres_id']);
            }

            if (isset($attributes['categories_id'])) {
                $newVideo->categories()->sync($attributes['categories_id']);
            }

            $this->commit();
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }

        return $newVideo;
    }

    /**
     * Update a specific video.
     *
     * @param $attributes
     * @param $video
     * @return Collection|Video
     * @throws Exception
     */
    public function update($attributes, $video): Collection|Video
    {
        $videoUpdated = null;

        try {
            $this->beginTransaction();

            $videoUpdated = $this->repository->updateById($video->id, $attributes);

            if (isset($attributes['genres_id'])) {
                $videoUpdated->genres()->sync($attributes['genres_id']);
            }

            if (isset($attributes['categories_id'])) {
                $videoUpdated->categories()->sync($attributes['categories_id']);
            }

            $this->commit();
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }

        return $videoUpdated;
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
