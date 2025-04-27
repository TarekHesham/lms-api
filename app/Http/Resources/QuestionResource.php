<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'question_id'   => $this->id,
            'question'      => $this->question,
            'question_type' => $this->question_type,
            'points'        => (int) $this->points,
            'options'       => OptionResource::collection($this->options),
        ];
    }
}
