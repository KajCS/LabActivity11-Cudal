<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->author !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:120'],
            'body'         => ['required', 'string', 'min:20'],
            'category'     => ['required', 'in:Announcement,Health,Peace & Order,Ayuda,Livelihood'],
            'tags'         => ['required', 'array', 'min:1'],
            'tags.*'       => ['exists:tags,id'],
            'is_published' => ['boolean'],
        ];
    }
}
