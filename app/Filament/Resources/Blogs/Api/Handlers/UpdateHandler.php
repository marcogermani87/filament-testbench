<?php
namespace App\Filament\Resources\Blogs\Api\Handlers;

use App\Filament\Resources\Blogs\Api\Requests\UpdateBlogRequest;
use App\Filament\Resources\Blogs\BlogResource;
use Dedoc\Scramble\Attributes\Group;
use Rupadana\ApiService\Http\Handlers;

#[Group('Blog')]
class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = BlogResource::class;
    protected static string $permission = 'Update:Blog';

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
