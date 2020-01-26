<?php

namespace App\Http\Controllers\Auth;

use App\Mail\newPassword;
use App\Services\GildeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gilde;
use Auth;
use Mail;

class GildeLoginController extends Controller
{
    protected $gildeservice;

    public function __construct(GildeService $gildeservice)
    {
        $this->gildeservice = $gildeservice;
    }

    public function showLoginForm()
    {
      return view('auth.gilde-login');
    }

    public function login(Request $request)
    {
      //Validate data
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:8'
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

      $gilde = Gilde::where('email', $request->email)->firstOrFail();
      $password = $this->gildeservice->newPassword($gilde->id);

      Mail::to($gilde)->send(new newPassword($gilde, $password));

      return redirect(route('gilde.login'))->with('succes', 'Nieuw wachtwoord verzonden naar ' . $gilde->email);
    }
}
