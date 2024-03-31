<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class PostResourceCollection
 * @package App\Http\Resources\Post
 */
class PostResourceCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = PostResource::class;
    
}
