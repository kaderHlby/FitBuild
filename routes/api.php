<?php
use App\Models\User;
use App\Models\member;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\memberResource;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\coachController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ExcerciseController;
use App\Http\Controllers\CoachMemberController;
use App\Http\Controllers\coach_memberController;
use App\Http\Controllers\neutritionistController;
use App\Http\Controllers\MemberExcerciseController;
use App\Http\Controllers\PlanedExcerciseController;
use App\Http\Controllers\NeutritionistMemberController;

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

Route::group([
    'middleware' => 'api'
], function () {
    Route::group(
        [
            'prefix' => 'auth'
        ]
        ,
        function ($router) {
            Route::post('/login', [AuthController::class, 'login']);
            Route::post('/register', [AuthController::class, 'register']);

        }
    );
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::apiResource('members', memberController::class);
        Route::patch('/profile', [MemberController::class, 'profile']);
        Route::apiResource('coaches', coachController::class);
        Route::patch('/Cprofile', [coachController::class, 'Cprofile']);
        Route::apiResource('Neutritionist', neutritionistController::class);
        Route::patch('/Nprofile', [neutritionistController::class, 'Nprofile']);


        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/user-profile', [AuthController::class, 'userProfile']);

        Route::post('/coachesR/{coach}', [CoachMemberController::class, 'sendRequest']);

        Route::get('/coach/{coachId}', [CoachMemberController::class, 'showRequests']);
        Route::get('/coach/{coachId}/sub', [CoachMemberController::class, 'showsubscribers']);
        Route::post('/coachesAccept/{id}', [CoachMemberController::class, 'AcceptRequest']);
        Route::post('/coachesReject/{id}', [CoachMemberController::class, 'RejectRequest']);

        Route::post('/neutritionistsR/{neutritionist}', [NeutritionistMemberController::class, 'sendRequest']);
        Route::get('/neutritionist/{neutritionistId}', [NeutritionistMemberController::class, 'showRequests']);
        Route::get('/neutritionist/{neutritionistId}/sub', [NeutritionistMemberController::class, 'showsubscribers']);
        Route::post('/neutritionistsAccept/{id}', [NeutritionistMemberController::class, 'AcceptRequest']);
        Route::post('/neutritionistsReject/{id}', [NeutritionistMemberController::class, 'RejectRequest']);

        Route::patch('/plan', [PlanedExcerciseController::class, 'plan']);


    });

});


Route::apiResource('Excercises', ExcerciseController::class)->except([
    'create', 'show', 'edit'
]);;
Route::apiResource('PlanedExcercise',PlanedExcerciseController::class)->except([
    'create', 'show', 'edit'
]);






