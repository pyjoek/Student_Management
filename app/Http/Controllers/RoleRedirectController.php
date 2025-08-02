<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRedirectController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        if ($user->role == ('admin')) {
            return redirect('/dashboard');
        } elseif ($user->role == ('lecture')) {
            return redirect('/dashbaord');
        } elseif ($user->role == ('student')) {
            return redirect('/student');
        }

        abort(403, 'Unauthorized');
    }
}

