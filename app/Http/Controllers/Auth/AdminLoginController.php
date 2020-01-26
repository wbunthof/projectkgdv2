<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
      return view('auth.admin-login');
    }

    public function login(Request $request)
    {
      //Validate data
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:8'
      ]);

      //Attempt to log in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        //If successful, then redirect intended location
        return redirect()->intended(route('admin.dashboard'));
      }

      //If unsuccessful, then route back to the form
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
