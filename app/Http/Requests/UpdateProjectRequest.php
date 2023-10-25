<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      // 'title' => ['required', 'string', 'unique:posts,id,' . $this->post->id],

      'title' => [
        'required',
        'string',
        Rule::unique('projects')->ignore($this->project->id)
      ],
      'content' => ['required', 'string'],
      'type_id' => ['nullable', 'exists:typies,id']

    ];
  }

  public function messages()
  {
    return [
      'title.required' => 'Il titolo è obbligatorio',
      'title.string' => 'Il titolo deve essere una stringa',
      'title.unique' => 'Esiste già un post con questo titolo',

      'content.required' => 'Il contenuto è obbligatorio',
      'content.string' => 'Il contenuto deve essere una stringa',

      'type_id.exists' => 'La categoria inserita non è valida'
    ];
  }
}