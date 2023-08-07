<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{

    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->dtInicio,
            'id_category' => $this->category->id,
            'name_category' => $this->category->name,
            'color_category' => $this->category->color,
            'icon_category' => $this->category->icon,
            'status' => $this->status_task == 1 ? true : false
        ];
    }
}
