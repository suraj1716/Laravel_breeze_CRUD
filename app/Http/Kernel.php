namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Router;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Other middleware...
        'permission' => PermissionMiddleware::class,  // Add this line to register the permission middleware
    ];
}
