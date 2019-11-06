<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class RaadsheerLoginController extends Controller
{
    public function showLoginForm()
    {
      return view('auth.raadsheer-login');
    }

    public function login(Request $request)
    {
      //Validate data
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);

      //Attempt to log in
      if (Auth::guard('raadsheer')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        //If successful, then redirect intended location
        return redirect()->intended(route('raadsheer.dashboard'));
      }

      //If unsuccessful, then route back to the form
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
