<?php

namespace App\UseCases\IntraClaim;

use App\Http\Requests\IntraClaim\IntraApproveClaimRequest;
use App\Models\Departure;
use App\Models\IntraClaim;

class IntraApproveClaimAction
{
    public function __invoke(IntraClaim $intraClaim, IntraApproveClaimRequest $request)
    {
        $intraUserId = $request->user()->id;
        $departure = $intraClaim->departure;

        if ($request->user()->id !== $intraClaim->intra_user_id) {
            return response()->json(['error' => 'You can only update your own departure.'], 403);
        }

        $departure->update(['intra_user_id' => $intraUserId]);

        $intraClaim->delete();

        $departure->refresh();

        return response()->json([
            'message' => 'イントラを登録しました',
            'data' => $departure
        ], 200);
    }
}