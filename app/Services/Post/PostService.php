<?php

namespace App\Services\Post;

use App\DTOs\Post\PostDTO;
use App\Repositories\BaseRepository;
use App\Repositories\Post\PostRepository;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PostService
 * @package App\Services\Post
 */
class PostService implements ServiceInterface
{
    /**
     * @var PostRepository
     */
    protected PostRepository $postRepository;

    /**
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @return BaseRepository
     */
    public function repository(): BaseRepository
    {
        return $this->postRepository;
    }

    /**
     * @param PostDTO $getPostDTO
     *
     * @return Model
     */
    public function createPost(PostDTO $getPostDTO): Model
    {
        return $this->repository()
                    ->create($getPostDTO->toArray());
    }
}
