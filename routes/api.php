<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SpecialtiesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\Api\AccessTokensController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// middleware('auth:sanctum')->
Route::get('/user', function (Request $request) {
    return $request->user();
});


//about route
// , 'auth:sanctum'
Route::group(['middleware' => ['XSS', 'lang']], function () {
    Route::apiResource('about', AboutController::class);
    Route::post('Filter', [ProjectController::class, 'filter'])->middleware('auth:sanctum');
    Route::apiResource('projects', ProjectController::class)->middleware('auth:sanctum');

    // Route::post('/role/store', [RoleController::class, 'store']);
    // Route::get('/role/delete/{id}', [RoleController::class, 'destroy']);
    // Route::post('/role/update/{id}', [RoleController::class, 'update']);

    // Route::post('/permission/store', [PermissionController::class, 'store']);
    // Route::get('/permission/delete/{id}', [PermissionController::class, 'destroy']);
    // Route::post('/permission/update/{id}', [PermissionController::class, 'update']);

    Route::get('/user/delete/{id}', [UserController::class, 'destroy']);

    Route::Post('auth/register', [AccessTokensController::class, 'register']);
    //يجب أن يكون مضيف لعمل إضافة للبيانات
    Route::post('auth/access-tokens', [AccessTokensController::class, 'store'])->middleware('guest');
    Route::get('auth/logout/{token?}', [AccessTokensController::class, 'destroy'])->middleware('auth:sanctum');
});

// Route::Post('auth/token', [AccessTokensController::class, 'store']);

// Route::prefix('cms/')->group(
    // function () {
        // Route::get('specialties/show/{slug}', [SpecialtiesController::class, 'show']);
        // Route::post('specialties/update/{slug}', [SpecialtiesController::class, 'update']);
        // Route::post('specialties/delete/{slug}', [SpecialtiesController::class, 'destroy']);
        // Route::apiResource('specialties', SpecialtiesController::class);

        // Route::get('profession/show/{slug}', [SpecialtiesController::class, 'show']);
        // Route::post('profession/update/{slug}', [SpecialtiesController::class, 'update']);
        // Route::post('profession/delete/{slug}', [SpecialtiesController::class, 'destroy']);
        // Route::apiResource('profession', ProfessionController::class);

        // Route::get('worker/show/{slug}', [SpecialtiesController::class, 'show']);
        // Route::Post('worker/update/{slug}', [WorkerController::class, 'update']);
        // Route::post('worker/delete/{slug}', [SpecialtiesController::class, 'destroy']);
        // Route::apiResource('worker', WorkerController::class);
    // }

// );
