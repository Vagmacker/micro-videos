<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Services\GenreService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GenreController extends Controller
{
    /**
     * GenreController constructor.
     * @param GenreService $service
     */
    public function __construct(public GenreService $service)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Response
     */
    public function index(): Response|JsonResponse
    {
        $genres = $this->service->findAll();

        return GenreResource::collection($genres)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GenreRequest $request
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function store(GenreRequest $request): JsonResponse|Response
    {
        $newGenre = $this->service->save($request->all());
        $resource = new GenreResource($newGenre);

        return $resource->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Genre $genre
     * @return JsonResponse|Response
     */
    public function show(Genre $genre): JsonResponse|Response
    {
        $resource = new GenreResource($genre);

        return $resource->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GenreRequest $request
     * @param Genre $genre
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function update(GenreRequest $request, Genre $genre): JsonResponse|Response
    {
        $genre = $this->service->update($request->all(), $genre);
        $resource = new GenreResource($genre);

        return $resource->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Genre $genre
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function destroy(Genre $genre): JsonResponse|Response
    {
        $this->service->delete($genre);

        return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
