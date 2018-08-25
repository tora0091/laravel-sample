<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleValidatePostRequest extends FormRequest
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
            'from' => 'required|date_format:"Y/m/d"|before_or_equal:to',
            'to' => 'required|date_format:"Y/m/d"|after_or_equal:from',
            'team' => 'required',
            'work_title' => 'array_required',
            'material' => 'array_required|material_number:number',
            'number' => 'array_numbers',
            'schedule_no' => 'schedule_no_format',
        ];
    }

    /**
     * Get the validation messages that aplly to request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'from.required' => '開始日時を入力してください',
            'from.date_format' => '開始日時の形式が異なります',
            'from.before_or_equal' => '開始日時は終了日時より以前を指定してください',
            'to.required' => '終了日時を入力してください',
            'to.date_format' => '終了日時の形式が異なります',
            'to.after_or_equal' => '終了日時は開始日時より以降を指定してください',
            'team.required' => '班を入力してください',
            'work_title.array_required' => '件名を入力してください',
            'material.array_required' => '機材の種類を入力してください',
            'material.material_number' => '機材の数量を正しく入力してください',
            'number.array_numbers' => '機材は数値で入力してください',
            'schedule_no.schedule_no_format' => 'スケジュール管理番号が不正です。最初からやり直してください。',
        ];
    }
}
