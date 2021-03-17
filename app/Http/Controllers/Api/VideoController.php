<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use App\Services\VideoService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    public function __construct(public VideoService $service)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|JsonResponse|AnonymousResourceCollection
     */
    public function index(): Response|JsonResponse|AnonymousResourceCollection
    {
        $videos = $this->service->findAll();

        return CategoryResource::collection($videos)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param VideoRequest $request
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function store(VideoRequest $request): JsonResponse|Response
    {
        $newVideo = $this->service->save($request->all());
        $resource = new VideoResource($newVideo);

        return $resource->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Video $video
     * @return JsonResponse|Response
     */
    public function show(Video $video): JsonResponse|Response
    {
        $resource = new VideoResource($video);

        return $resource->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VideoRequest $request
     * @param Video $video
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function update(VideoRequest $request, Video $video): JsonResponse|Response
    {
        $video = $this->service->update($request->all(), $video);
        $resource = new VideoResource($video);

        return $resource->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Video $video
     * @return JsonResponse|Response
     * @throws Exception
     */
    public function destroy(Video $video): JsonResponse|Response
    {
        $this->service->delete($video);

        return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
