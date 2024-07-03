<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BaseCRUDRequest extends FormRequest
{
    private $customRules = [];
    private $table = "";
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required"]
        ];
    }

    public function setTableName(string $table){
        $this->table = $table;
    }
    public function setCustomRules(array $rules)
    {
        $this->customRules = $rules;
    }

    public function mergedRules(): array
    {
        return array_merge($this->rules(), $this->customRules);
    }
}
