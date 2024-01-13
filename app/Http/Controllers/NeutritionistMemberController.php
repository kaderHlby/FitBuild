<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Neutritionist;
use App\Models\NeutritionistMember;
use Illuminate\Support\Facades\Auth;

class NeutritionistMemberController extends Controller
{
    public function sendRequest(Neutritionist $Neutritionist)
    {

        $member = Auth::user()->member;

        if (!$member->neutritionists->contains($Neutritionist->id)) {

            $member->neutritionists()->attach($Neutritionist, ['status' => 'pending']);

            return response()->json(['message' => 'Request sent successfully!'], 200);
        } else {
            return response()->json(['error' => 'You already have a pending request with this Neutritionist.'], 400);
        }
    }
    public function showRequests(Request $request, $NeutritionistId)
    {
        $Neutritionist = Neutritionist::findOrFail($NeutritionistId);
        $memberNames = $Neutritionist->members()
            ->wherePivot('status', 'pending')
            ->pluck('name');

        return response()->json($memberNames);
    }
    public function AcceptRequest($id)
    {
        $data = NeutritionistMember::find($id);
        $data->status = 'Accepted';
        $data->save();
        return response()->json(['message' => 'Request Accepted successfully!'], 200);

    }
    public function RejectRequest($id)
    {
        $data = NeutritionistMember::find($id);
        $data->status ='Rejected';
        $data->save();
        return response()->json(['message' => 'Request Rejected successfully!'], 200);
    }
    public function showsubscribers(Request $request, $NeutritionistId)
    {
        $Neutritionist = Neutritionist::findOrFail($NeutritionistId);
        $memberNames = $Neutritionist->members()
            ->wherePivot('status', 'Accepted')
            ->pluck('name');

        return response()->json($memberNames);
    }
}
