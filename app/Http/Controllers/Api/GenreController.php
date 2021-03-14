<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Models\Genre;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Response
     */
    public function index(): JsonResponse|Response
    {
        return response()
            ->json(Genre::all())
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GenreRequest $request
     * @return JsonResponse
     */
    public function store(GenreRequest $request): JsonResponse
    {
        return response()
            ->json(Genre::create($request->all()))
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Genre $genre
     * @return JsonResponse
     */
    public function show(Genre $genre): JsonResponse
    {
        return response()
            ->json($genre)
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Genre $genre
     * @return JsonResponse
     */
    public function update(Request $request, Genre $genre): JsonResponse
    {
        return response()
            ->json($genre->update($request->all()))
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Genre $genre
     * @return Response
     * @throws Exception
     */
    public function destroy(Genre $genre): Response
    {
        $genre->delete();
        return response()->noContent();
    }
}
