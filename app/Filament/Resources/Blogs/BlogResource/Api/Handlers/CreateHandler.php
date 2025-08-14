<?php
namespace App\Filament\Resources\Blogs\BlogResource\Api\Handlers;

use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\Blogs\BlogResource\Api\Requests\CreateBlogRequest;

#[Group('Blog')]
class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = BlogResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Blog
     *
     * @param CreateBlogRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateBlogRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}
