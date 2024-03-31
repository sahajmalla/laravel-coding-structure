<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    /**
     * PostRepository constructor.
     *
     * @param Post $postModel
     */
    public function __construct(Post $postModel)
    {
        parent::__construct($postModel);
    }
}
