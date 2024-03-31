<?php

namespace App\DTOs\Post;

use ArrayAccess;
use Illuminate\Support\Arr;

/**
 * Class PostDTO
 * @package App\DTOs\Post
 */
class PostDTO
{
    /**
     * @var string|array|ArrayAccess|mixed
     */
    protected string $title;
    /**
     * @var string|array|ArrayAccess|mixed
     */
    protected string $description;
    /**
     * @var string|array|ArrayAccess|mixed
     */
    protected string $content;
    /**
     * @var int
     */
    protected int $userId;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->title       = Arr::get($data, 'title');
        $this->description = Arr::get($data, 'description');
        $this->content     = Arr::get($data, 'content');
        $this->userId      = Arr::get($data, 'user_id');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title'       => $this->title,
            'description' => $this->description,
            'content'     => $this->content,
            'user_id'     => $this->userId,
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
