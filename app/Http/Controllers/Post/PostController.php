<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Resources\Post\PostResourceCollection;
use App\Services\Post\PostService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;

/**
 * Class PostController
 * @package App\Http\Controllers\Post
 */
class PostController extends Controller
{
    /**
     * @var PostService
     */
    protected PostService $postService;

    /**
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $posts = $this->postService->repository()
                                       ->getQueryBuilder()
                                       ->allowedIncludes('user')
                                       ->allowedFilters(['title', AllowedFilter::scope('user_email'),])
                                       ->allowedSorts('created_at', 'updated_at')
                                       ->paginate();


            return $this->sendSuccessResponse(new PostResourceCollection($posts), 'Successfully fetched posts');
        } catch (Exception $exception) {
            logger()->error($exception);

            return $this->sendErrorResponse();
        }
    }

    /**
     * @param StorePostRequest $postRequest
     *
     * @return JsonResponse
     */
    public function store(StorePostRequest $postRequest): JsonResponse
    {
        try {
            $this->postService->createPost($postRequest->getPostDTO());

            return $this->sendSuccessResponse([], 'Successfully stored post');
        } catch (Exception $exception) {
            Log::error($exception);

            return $this->sendErrorResponse();
        }
    }
}
