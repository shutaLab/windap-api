<?php

namespace App\UseCases\User;

use App\Http\Requests\User\ProfileStoreRequest;
use App\Http\Resources\Common\SuccessResource;
use App\Models\UserProfile;

class ProfileStoreAction
{
    public function __invoke(ProfileStoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        $profile = UserProfile::create($validated);

        return new SuccessResource('プロフィール登録に成功しました');
    }
}
