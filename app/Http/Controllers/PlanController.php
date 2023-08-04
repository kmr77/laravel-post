<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PlanController extends Controller
{
    public function attach(Request $request, User $user) {
        $planId=request()->input('plan');
        $user->plans()->attach($planId);
        return back();
    }
    public function detach(Request $request, User $user) {
        $planId=request()->input('plan');
        $user->plans()->detach($planId);
        return back();
    }
}
