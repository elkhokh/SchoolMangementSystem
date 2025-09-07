<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */

    protected $guards = ['web', 'teacher', 'student'];


     public function create(): View
    {

        return view('auth.selection');
    }

    public function createWith($type)
    {
        if(in_array($type, ['student','admin' , 'teacher'])) {
        return view('auth.login' , compact('type'));
        }
        return abort(404);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request ): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::guard('web')->check()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }
        if (Auth::guard('doctor')->check()) {
            return redirect()->intended(route('teacher.dashboard.index', absolute: false));
        }

        return redirect()->intended(route('student.dashboard.index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        foreach ($this->guards as $guard) {
            if (Auth::guard($guard)->check()) {
                Auth::guard($guard)->logout();
                break;
            }
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
