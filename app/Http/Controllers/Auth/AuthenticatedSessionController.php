<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\PeriodePendidikan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Notifiable;
use \Spatie\Permission\Traits\HasRoles;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(route('dashboard', absolute: false));
        $request->authenticate();

        $request->session()->regenerate();

        $periode_id = PeriodePendidikan::query()->latest()->value('id');

        $request->session()->put('periode_id', $periode_id);

        if (Auth::user()->hasRole('administrator')) {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        } elseif (Auth::user()->hasRole('calon_peserta')) {
            return redirect()->intended(RouteServiceProvider::CALON);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function setPeriode(Request $request)
    {
        // dd($request);
        // $request->session()->put('periode_id', $request->periode_id);
        if ($request->periode_id) {
            $request->session()->put('periode_id', $request->periode_id);
        }
        return redirect()->back();
    }
}
