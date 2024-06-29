<?php

namespace App\UseCases\User;

use App\Http\Requests\User\ProfileStoreRequest;
use App\Models\UserProfile;

class ProfileStoreAction
{
    public function __invoke(ProfileStoreRequest $request)
    {
        $validated = $request->validated();

        $profile = UserProfile::create($validated);

        return response()->json([
            'message' => 'プロフィールの投稿に成功しました',
            'profile' => $profile
        ], 200);
    }
}
