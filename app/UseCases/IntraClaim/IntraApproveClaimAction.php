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
        // ログインユーザ(イントラを依頼されたユーザ)
        $intraUser = $request->user();
        $intraUserName = $intraUser->userProfile->name;

        $departure = $intraClaim->departure;

        // イントラを依頼したユーザ
        $departureUser = User::find($departure->user_id);
        $departureUserName = $departureUser->userProfile->name;

        if ($request->user()->id !== $intraClaim->intra_user_id) {
            return response()->json([
                'message' => 'イントラ依頼を承諾する権限がありません'
            ], 403);
        }

        $departure->update(['intra_user_id' => $intraUser->id]);

        $comment = "{$intraUserName}さんと{$departureUserName}のイントラが確定しました";

        $departureUser->notify(new IntraClaimNotification($intraClaim, $comment));
        $intraUser->notify(new IntraClaimNotification($intraClaim, $comment));

        $intraClaim->delete();
        $departure->refresh();

        return response()->json([
            'message' => 'イントラ依頼を承諾しました',
            'data' => $departure
        ], 200);
    }
}