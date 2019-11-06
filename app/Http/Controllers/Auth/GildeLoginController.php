<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gilde;
use Auth;
use App\Http\Controllers\AdminController;

class GildeLoginController extends Controller
{
    public function showLoginForm()
    {
      return view('auth.gilde-login');
    }

    public function login(Request $request)
    {
      //Validate data
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);

      //Attempt to log in
      if (Auth::guard('gilde')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        //If successful, then redirect intended location
        return redirect()->intended(route('gilde.dashboard'));
      }

      //If unsuccessful, then route back to the form
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function FormNieuwWachtwoordGildeEmail()
    {
      return view('auth.gilde-nieuw-wachtwoord');
    }

    public function NieuwWachtwoordGildeEmail(Request $request)
    {
      if (!isset($request->email)) {
        return view('auth.gilde-login')->with('error', 'Fout');
      }
      if (Gilde::where('email', $request->email)->count() < 1) {
        return view('auth.gilde-login')->with('error', 'Fout');
      }

      $gilde = Gilde::where('email', $request->email)->first();

      return AdminController::gildeNieuwWachtwoord($gilde->id);
    }
}
