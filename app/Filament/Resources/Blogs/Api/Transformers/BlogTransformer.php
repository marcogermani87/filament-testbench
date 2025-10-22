<?php
namespace App\Filament\Resources\Blogs\Api\Transformers;

use App\Models\Blog;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Blog $resource
 */
class BlogTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
