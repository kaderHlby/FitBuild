<?php

namespace App\Http\Controllers;

use App\Models\Excercise;
use Illuminate\Http\Request;
use App\Http\Resources\ExcerciseResource;
use App\Http\Requests\StoreExcerciseRequest;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class ExcerciseController extends Controller
{
    public function index()
    {
        $Excercise = Excercise::all();
        return ExcerciseResource::collection($Excercise);
    }

    public function store(StoreExcerciseRequest $request)
    {
        $Excercise = Excercise::create($request->all());

        return new ExcerciseResource($Excercise);
    }


    public function update(StoreExcerciseRequest $request, Excercise $Excercise)
    {
        $Excercise->update($request->all());

        return new ExcerciseResource($Excercise);
    }

    public function destroy(Excercise $Excercise)
    {
        $Excercise->delete();

        return response(null, 204);
    }
}

