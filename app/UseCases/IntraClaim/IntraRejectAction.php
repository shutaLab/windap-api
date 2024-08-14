<?php

namespace App\UseCases\IntraClaim;

use App\Http\Requests\IntraClaim\IntraRejectRequest;
use App\Models\IntraClaim;
use App\Models\User;
use App\Notifications\IntraClaimNotification;

class IntraRejectAction
{
    public function __invoke(IntraClaim $intraClaim, IntraRejectRequest $request)
    {
        $departure = $intraClaim->departure;

        // ログインユーザ(イントラを依頼されたユーザ)
        $intraUser = User::find($request->user()->id);
        $intraUserName = $intraUser->userProfile->name;

        // イントラを依頼したユーザ
        $departureUser = User::find($departure->user_id);
        $departureUserName = $departureUser->userProfile->name;

        if ($intraUser->id !== $intraClaim->intra_user_id) {
            return response()->json([
                'message' => '依頼取り下げる権限がありません'
            ], 403);
        }

        $comment = "{$intraUserName} id:{$intraUser->id}が{$departureUserName} id: {$departureUser->id}のイントラ依頼を取り下げました";
        
        $departureUser->notify(new IntraClaimNotification($intraClaim, $comment));

        $intraClaim->delete();

        return response()->json([
            'message' => 'イントラ依頼を取り下げました',
            'data' => $intraClaim
        ], 200);
    }
}