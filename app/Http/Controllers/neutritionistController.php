<?php

namespace App\Http\Controllers;

use app\Models\member;
use Illuminate\Http\Request;
use App\Models\Neutritionist;
/*use Illuminate\Foundation\Auth\User;*/
use App\Models\User;
use App\Http\Resources\NeutritionistResource;
use App\Http\Resources\NeutritionistCollection;
use App\Http\Requests\updateNeutritionistRequest;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class neutritionistController extends Controller
{
    public function index(Request $request)
    {
        return new NeutritionistCollection(Neutritionist::all());
    }
    public function show(Request $request, Neutritionist $Neutritionist)
    {
        return new NeutritionistResource($Neutritionist);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function Nprofile(Request $request, User $user, Auth $auth)
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

        if ($user->role !== 'Neutritionist') {
            return response()->json(['error' => 'User is not a Neutritionist'], 400);
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
        $Neutritionist = $user->Neutritionist()->create($validated);
        return new NeutritionistResource($Neutritionist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateNeutritionistRequest $request, Neutritionist $Neutritionist)
    {
        $validated = $request->validated();

        $Neutritionist->update($validated);

        return new NeutritionistResource($Neutritionist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Neutritionist $Neutritionist)
    {
        $Neutritionist->delete();

        return response(null, 204);
    }

    /*public function index()
    {
        $member = Neutritionist::find(1)->member;

        foreach ($member as $member) {
            echo $member->name;
            echo $member->phone_number;
            echo $member->Age;
            echo $member->Hieght;
            echo $member->Wieght;
            echo $member->target_Wieght;
            echo $member->illness;
        }
    }
    public function N_F()
    {

        $Neutritionist = Neutritionist::find(1);

        foreach ($Neutritionist->Food as $Food) {
            echo $Food->name;
        }

    }*/
}

