<?php

namespace App\UseCases\Departure;

use App\Http\Requests\Departure\DepartureStoreRequest;
use App\Models\Departure;
use App\Models\IntraClaim;
use App\Models\User;
use App\Notifications\IntraClaimNotification;
use Illuminate\Support\Arr;

class DepartureStoreAction
{
    public function __invoke(DepartureStoreRequest $request)
    {
        $validated = $request->validated();

        // ログインユーザ(イントラを依頼するユーザ)
        $departureUser = $request->user();
        $departureUserName = $departureUser->userProfile->name;
        $validated['user_id'] = $departureUser->id;

        // 上級生(イントラを依頼されるユーザ)の取得
        $intraUser = User::find($validated['intra_user_id'] ?? null);
        $intraUserName = $intraUser?->userProfile?->name;

        $departure = Departure::create(Arr::except($validated, ['intra_user_id']));

        $intraClaim = $intraUser ? IntraClaim::create([
            'user_id' => $departureUser->id,
            'intra_user_id' => $intraUser->id,
            'departure_id' => $departure->id,
        ]) : null;

        $intraUser?->notify(new IntraClaimNotification(
            $intraClaim, 
            "{$departureUserName} id: {$departureUser->id}が{$intraUserName} id:{$intraUser?->id}にイントラを依頼しました"
        ));

        return response()->json([
            'message' => '出艇の作成に成功しました',
            'data' => [$departure, $intraClaim]
        ], 200);
    }
}
