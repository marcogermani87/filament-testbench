<?php
namespace App\Filament\Resources\Blogs\Api\Handlers;

use App\Filament\Resources\Blogs\BlogResource;
use Dedoc\Scramble\Attributes\Group;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;

#[Group('Blog')]
class DeleteHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = BlogResource::class;
    protected static string $permission = 'Delete:Blog';

    public static function getMethod()
    {
        return Handlers::DELETE;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Delete Blog
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(Request $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->delete();

        return static::sendSuccessResponse($model, "Successfully Delete Resource");
    }
}
