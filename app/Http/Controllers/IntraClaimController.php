<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntraClaim\IntraApproveClaimRequest;
use App\Http\Requests\IntraClaim\IntraClaimCreateRequest;
use App\Http\Requests\IntraClaim\IntraRejectRequest;
use App\Models\Departure;
use App\Models\IntraClaim;
use App\UseCases\IntraClaim\IntraApproveClaimAction;
use App\UseCases\IntraClaim\IntraClaimCreateAction;
use App\UseCases\IntraClaim\IntraRejectAction;

class IntraClaimController extends Controller
{
    public function approveClaim(IntraClaim $intraClaim, IntraApproveClaimRequest $request, IntraApproveClaimAction $action)
    {
        return $action($intraClaim, $request);
    }

    public function rejectClaim(IntraClaim $intraClaim, IntraRejectRequest $request, IntraRejectAction $action)
    {
        return $action($intraClaim, $request);
    }
}
