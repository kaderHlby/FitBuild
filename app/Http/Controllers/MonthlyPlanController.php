<?php

namespace App\Http\Controllers;

use App\Models\DayPlan;
use App\Models\MonthlyPlan;
use Illuminate\Http\Request;
use App\Models\PlanedExcercise;
use Illuminate\Support\Facades\DB;

class MonthlyPlanController extends Controller
{
    public function createMonthlyPlan(Request $request, $memberId)
    {

            // Create monthly plan
            $monthlyPlan = new MonthlyPlan();
            $monthlyPlan->member_id = $memberId;
            $monthlyPlan->save();

            // Loop through days and exercises
            foreach ($request->days as $day) {
                $dayPlan = DayPlan::create([
                    // Day plan details
                ]);

                foreach ($day['exercises'] as $exerciseId) {
                    $plannedExercise = PlanedExcercise::where('exercise_id', $exerciseId)->first();

                    // Attach planned exercise to day plan with monthly plan as pivot
                    $dayPlan->plannedExercises()->attach($plannedExercise->id, ['monthly_plan_id' => $monthlyPlan->id]);
                }
            }


            return response()->json(['message' => 'Monthly plan created successfully.'], 200);

         
        }
    }

