<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\coach;
use Illuminate\Http\Request;
use App\Http\Resources\coachResource;
use App\Http\Resources\coachCollection;
use App\Http\Requests\updatecoacheRequest;

class coachController extends Controller
{
    public function index(Request $request)
    {

        return new coachCollection(coach::all());

    }
    public function show(Request $request, coach $coach)
    {
        return new coachResource($coach);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function Cprofile(Request $request, User $user)
    {
        $validated = $request->validate([
            'WorkHours' => 'required|string',
            'gender' => 'required|in:male,female',
            'phone_number' => 'required|string',
            'Age' => 'required|integer|min:0',
        ]);
        $userId = auth()->id();
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 400);
        }

        if ($user->role !== 'Coach') {
            return response()->json(['error' => 'User is not a Coach'], 400);
        }
        $validated = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'gender' => $validated['gender'],
            'phone_number' => $validated['phone_number'],
            'Age' => $validated['Age'],
            'WorkHours' => $validated['WorkHours'],
        ];
        $coach = $user->coach()->create($validated);
        return new coachResource($coach);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(updatecoacheRequest $request, coach $coach)
    {
        $validated = $request->validated();

        $coach->update($validated);

        return new coachResource($coach);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, coach $coach)
    {
        $coach->delete();

        return response(null, 204);
    }

   
}
