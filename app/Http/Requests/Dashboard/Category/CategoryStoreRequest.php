<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $rules = [];
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $rules += [
                'name.' . $localeCode => ['required', Rule::unique('categories', 'name->' . $localeCode)],
            ];
        }
        return $rules;
    }
}
