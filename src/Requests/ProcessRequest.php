<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\NumberParseException;


class ProcessRequest extends FormRequest
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
            'cellphone' => 'required|phone:IR,mobile',
            'id_code' => 'required|melli_code',
        ];
    }

    public function messages()
    {
        return [
            'cellphone.required' => 'وارد کردن تلفن همراه الزامی است',
            'cellphone.phone' => 'فرمت تلفن همراه صحیح نمی باشد',
            'id_code.melli_code' => 'لطفا کد ملی مجاز وارد کنید',
            'id_code.required' => 'وارد کردن کد ملی الزامی است',
        ];
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator'
     */
    protected function getValidatorInstance()
    {
        $request = $this->all();

        if (!empty($request['cellphone'])) {
            try {
                $request['cellphone'] = phone(
                    $request['cellphone'],
                    $country_code = 'IR',
                    $format = PhoneNumberFormat::E164
                );
            } catch (NumberParseException $e) {
            }
        }

        $this->getInputSource()->replace($request);

        // Fire the parent getValidatorInstance method
        return parent::getValidatorInstance();
    }
}
