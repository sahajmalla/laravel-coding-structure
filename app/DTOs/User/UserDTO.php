<?php

namespace App\DTOs\User;

use ArrayAccess;
use Illuminate\Support\Arr;

/**
 * Class UserDTO
 * @package App\DTOs
 */
class UserDTO
{
    /**
     * @var string|array|ArrayAccess|mixed
     */
    protected string $name;

    /**
     * @var string|array|ArrayAccess|mixed
     */
    protected string $email;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->name  = Arr::get($data, 'name');
        $this->email = Arr::get($data, 'email');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->email,
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}
