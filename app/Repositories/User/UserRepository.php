<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     *
     * @param User $postModel
     */
    public function __construct(User $postModel)
    {
        parent::__construct($postModel);
    }
}
