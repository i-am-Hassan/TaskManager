<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var User $user */
        $user = Auth::user();

        $taskCount = $user->tasks()->count();

        return view('profile', [
            'user' => $user,
            'taskCount' => $taskCount,
        ]);
    }
}
