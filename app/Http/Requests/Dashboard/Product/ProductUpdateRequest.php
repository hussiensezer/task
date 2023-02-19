<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'category' => ['required', Rule::exists('categories', 'id')],
            'image' => ['sometimes','nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $rules += [
                'name.' . $localeCode => ['required', Rule::unique('products', 'name->' . $localeCode)->ignore($this->product->id)],
                'description.' . $localeCode => ['required', 'string'],
            ];
        }
        return $rules;
    }
}
