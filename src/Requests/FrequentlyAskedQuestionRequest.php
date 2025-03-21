<?php

namespace LilianBellini\PluginCmsLaravel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrequentlyAskedQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ];
    }
}
