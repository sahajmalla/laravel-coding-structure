<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class UserResourceCollection
 * @package App\Http\Resources\User
 */
class UserResourceCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public $collects = UserResource::class;
}
