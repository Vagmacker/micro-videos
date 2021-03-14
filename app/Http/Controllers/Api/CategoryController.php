<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     * @param CategoryService $service
     */
    public function __construct(public CategoryService $service)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|AnonymousResourceCollection|Response
     */
    public function index(): Response|JsonResponse|AnonymousResourceCollection
    {
        $categories = $this->service->findAll();

        return CategoryResource::collection($categories)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $newCategory = $this->service->save($request->all());
        $resource = new CategoryResource($newCategory);

        return $resource->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return JsonResponse|Response
     */
    public function show(Category $category): JsonResponse|Response
    {
        $resource = new CategoryResource($category);

        return $resource->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse|Response
    {
        $this->service->update($request->all(), $category);

        return $this->resource->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function destroy(Category $category): Response|JsonResponse
    {
        $this->service->delete($category);

        return $this->resource->response()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
