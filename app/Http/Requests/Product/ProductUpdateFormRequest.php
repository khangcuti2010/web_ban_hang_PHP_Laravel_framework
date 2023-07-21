<?php

namespace App\Http\Requests\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ProductUpdateFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array //kiểm tra rule nhưng bỏ qua id hiện tại
    {

        return [
            'name' => [
                'required',
                Rule::unique('products')->ignoreModel($this->id)
            ],
        ];

    }
    public function messages()
    {
        return [
            'name.required'=>'Vui lòng nhập tên Sản phẩm',
            'name.unique'=>'Tên Sản Phẩm đã tồn tại'
        ];
    }
}
