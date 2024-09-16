<?php

namespace App\Http\Resources\Lead;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowLeadResource extends JsonResource
{
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id
            , 'name' => $this->name
            , 'source' => $this->source
            , 'owner' => $this->owner
            , 'created_at' => Carbon::create($this->created_at)->toDateTimeString()
            , 'created_by' => $this->created_by
        ];
    }
}
