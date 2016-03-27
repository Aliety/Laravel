<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TopicCreateRequest extends Request
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
            'name' => 'required',
            'college' => 'required',
            'grade' => 'required',
            'content' => 'required',
            'type' => 'required',
            'place' => 'required',
            'week' => 'required',
            'number' => 'required',
            'level' => 'required',
            'requirement' => 'required',
        ];
    }

    public function topicFillData()
    {
        return [
            'name' => $this->name,
            'college' => $this->college,
            'grade' => $this->grade,
            'content' => $this->get('content'),
            'type' => $this->type,
            'place' => $this->place,
            'week' => $this->week,
            'number' => $this->number,
            'level' => $this->level,
            'requirement' => $this->requirement,
            'profile' => $this->profile,
        ];
    }
}
