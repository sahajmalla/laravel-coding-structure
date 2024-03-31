<?php

namespace App\Services;

use App\Repositories\BaseRepository;

/**
 * Interface for Service classes
 */
interface ServiceInterface
{
    /**
     *
     * @return BaseRepository
     */
    public function repository(): BaseRepository;
}
