<?php

namespace App\Http\Requests\Post;

use App\Constants\DB;
use App\DTOs\Post\PostDTO;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StorePostRequest
 * @package App\Http\Requests\Post
 */
class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string'],
            'description' => ['required', 'string'],
            'content'     => ['required', 'string'],
            'user_id'     => ['required', Rule::exists(DB::USERS, "id")],
        ];
    }

    /**
     * @return PostDTO
     */
    public function getPostDTO(): PostDTO
    {
        return new PostDTO($this->validated());
    }
}
