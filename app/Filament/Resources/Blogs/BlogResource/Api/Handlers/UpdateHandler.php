<?php
namespace App\Filament\Resources\Blogs\BlogResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\Blogs\BlogResource;
use App\Filament\Resources\Blogs\BlogResource\Api\Requests\UpdateBlogRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = BlogResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Blog
     *
     * @param UpdateBlogRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateBlogRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}