<?php

namespace App\Http\Controllers;

use App\Models\Excercise;
use Illuminate\Http\Request;
use App\Models\PlanedExcercise;
use App\Http\Resources\PlanedExcerciseResource;
use App\Http\Requests\StorePlanedExcerciseRequest;

class PlanedExcerciseController extends Controller
{
    public function index(Request $request)
    {
        $single = PlanedExcercise::with('Excercise')->where("id", $request->id)->find($request);
        echo $single->Excercise->name . "name" .
            $single->Excercise->type . "type".
            $single->Excercise->description . "description" .
            $single->Excercise->video . "video" .
            $single->Excercise->EquipmentNeeded . "EquipmentNeeded" ;

        return new PlanedExcerciseResource(PlanedExcercise::all());
    }

 
    public function store(StorePlanedExcerciseRequest $request)
    {
        $PlanedExcercise = PlanedExcercise::create($request->all());

        return new PlanedExcerciseResource($PlanedExcercise);
    }

    public function plan(Request $request,Excercise $excercise)
    {

        $validated = $request->validate([
            'Duration' => 'nullable|string',
            'repeat_count' => 'nullable|string',
            'cycle_repetitions' => 'nullable|string',
        ]);

        $validated = [
            'excercise_id' => $excercise->id,
            'name' => $excercise->name,
            'type' => $excercise->type,
            'video' => $excercise->video,
            'EquipmentNeeded' => $excercise->EquipmentNeeded,
            'description' => $excercise->description,
            'Duration' => $validated['Duration'],
            'repeat_count' => $validated['repeat_count'],
            'cycle_repetitions' => $validated['cycle_repetitions'],
        ];

        $PlanedExcercise = $excercise->PlanedExcercise()->create($validated);
        return new PlanedExcerciseResource($PlanedExcercise);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePlanedExcerciseRequest $request, PlanedExcercise $PlanedExcercise)
    {
        $PlanedExcercise->update($request->all());

        return new PlanedExcerciseResource($PlanedExcercise);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanedExcercise $PlanedExcercise)
    {
        $PlanedExcercise->delete();

        return response(null, 204);
    }
}

