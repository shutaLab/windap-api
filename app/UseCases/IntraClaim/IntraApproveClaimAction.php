<?php

namespace App\UseCases\IntraClaim;

use App\Http\Requests\IntraClaim\IntraApproveClaimRequest;
use App\Models\Departure;
use App\Models\IntraClaim;
use App\Models\User;
use App\Notifications\IntraClaimNotification;

class IntraApproveClaimAction
{
    public function __invoke(IntraClaim $intraClaim, IntraApproveClaimRequest $request)
    {
        $intraUser = $request->user();
        $departure = $intraClaim->departure;
        $departureUser = User::find($departure->user_id);


        if ($request->user()->id !== $intraClaim->intra_user_id) {
            return response()->json(['error' => 'You can only update your own departure.'], 403);
        }

        $departure->update(['intra_user_id' => $intraUser->id]);

        $departureUser->notify(new IntraClaimNotification($intraClaim));
        $intraClaim->delete();

        $departure->refresh();

        return response()->json([
            'message' => 'イントラを登録しました',
            'data' => $departure
        ], 200);
    }
}