<?php

use App\Modules\DiningTable\Http\Controllers\DiningTableController;
use App\Modules\Reservation\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Modules\Tasks\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});
Route::get('/', function () {
    return response()->json([
        "success"=>false,
        "message"=>"Unauthorized"],401);
})->name('login');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(['auth:sanctum', 'abilities:check-status,place-orders']);
Route::controller(TaskController::class)->group(function () {
    Route::get("/tasks", "index");
    Route::get("/tasks/{id}", "show")->where("id", "[0-9]+");
    Route::post("/tasks", "store");
    Route::put("/tasks/{id}", "update")->where("id", "[0-9]+");
    Route::delete("/tasks/{id}", "destroy")->where("id", "[0-9]+");
});
Route::middleware(['auth:sanctum', 'abilities:check-status,place-orders'])->controller(DiningTableController::class)->group(function () {
    Route::get("/diningtables", "index");
    Route::get("/diningtable/{id}", "show")->where("id", "[0-9]+");
    Route::post("/diningtable", "store");
    Route::put("/diningtable/{id}", "update")->where("id", "[0-9]+");
    Route::delete("/diningtable/{id}", "destroy")->where("id", "[0-9]+");
});
Route::middleware(['auth:sanctum', 'abilities:check-status,place-orders'])->controller(ReservationController::class)->group(function () {
    Route::get("/reservations", "index");
    Route::get("/reservation/{id}", "show")->where("id", "[0-9]+");
    Route::post("/reservation/online", "store");
    Route::post("/reservation/walkin", "walkin");
    Route::put("/reservation/cancel/{id}", "cancel")->where("id", "[0-9]+");
    Route::delete("/reservation/{id}", "destroy")->where("id", "[0-9]+");
});
