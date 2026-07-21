<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'conversion_id' => $this->code,
            'order_code' => $this->order_code,
            'order_time' => $this->order_time,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'commission' => $this->commission,
            'status' => $this->status,
            'product_code' => $this->product_code,
            'product_name' => $this->product_name,
            'confirmed_at' => $this->confirmed_at,
            'paid_at' => $this->paid_at,
            'campaign_id' => $this->campaign_id,
            'sub1' => $row->click->linkHistory->sub1 ?? null,
            'sub2' => $row->click->linkHistory->sub2 ?? null,
            'sub3' => $row->click->linkHistory->sub3 ?? null,
            'sub4' => $row->click->linkHistory->sub4 ?? null,
        ];
    }
}
