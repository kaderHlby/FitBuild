<?php

namespace App\Http\Controllers;

use App\Models\DayPlan;
use Illuminate\Http\Request;
use App\Http\Resources\DayPlanResource;
use App\Http\Requests\StoreDayPlanRequest;

class DayPlanController extends Controller
{
    public function index()
    {
        $DayPlan = DayPlan::all();
        return DayPlanResource::collection($DayPlan);
    }


    public function store(StoreDayPlanRequest $request)
    {
        $DayPlan = DayPlan::create($request->all());

        return new DayPlanResource($DayPlan);
    }


    public function update(StoreDayPlanRequest $request, DayPlan $DayPlan)
    {
        $DayPlan->update($request->all());

        return new DayPlanResource($DayPlan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DayPlan $DayPlan)
    {
        $DayPlan->delete();

        return response(null, 204);
    }
}
