<?php

namespace App\Http\Controllers;

use App\Models\coach;
use App\Models\coach_member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachMemberController extends Controller
{
    public function sendRequest(coach $coach)
    {

        $member = Auth::user()->member;

        if (!$member->coaches->contains($coach->id)) {

            $member->coaches()->attach($coach, ['status' => 'pending']);

            return response()->json(['message' => 'Request sent successfully!'], 200);
        } else {
            return response()->json(['error' => 'You already have a pending request with this coach.'], 400);
        }
    }
    public function showRequests(Request $request, $coachId)
    {
        $coach = Coach::findOrFail($coachId);
        $memberNames = $coach->members()
            ->wherePivot('status', 'pending')
            ->pluck('name');

        return response()->json($memberNames);
    }
    public function AcceptRequest($id)
    {
        $data = coach_member::find($id);
        $data->status = 'Accepted';
        $data->save();
        return response()->json(['message' => 'Request Accepted successfully!'], 200);

    }
    public function RejectRequest($id)
    {
        $data = coach_member::find($id);
        $data->status = 'Rejected';
        $data->save();
        return response()->json(['message' => 'Request Rejected successfully!'], 200);
    }
    public function showsubscribers(Request $request, $coachId)
    {
        $coach = Coach::findOrFail($coachId);
        $memberNames = $coach->members()
            ->wherePivot('status', 'Accepted')
            ->pluck('name');

        return response()->json($memberNames);
    }
}
