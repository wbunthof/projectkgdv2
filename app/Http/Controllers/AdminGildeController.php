<?php

namespace App\Http\Controllers;

use App\Gilde;
use App\Mail\changeMail;
use App\Mail\deleteUser;
use App\Mail\newUser;
use App\Services\GildeService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Mail;

class AdminGildeController extends Controller
{
    /**
     * @var GildeService
     */
    protected $gildeService;

    public function __construct(GildeService $gildeService)
    {

        $this->gildeService = $gildeService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.gilde')->with('gilden', $this->gildeService->index());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email|unique:Gilde',
            'id'  => 'required|numeric|unique:Gilde,id',
            'name'    => 'required|string',
            'locatie' => 'required|string'
        ]);

        try {
            $create = $this->gildeService->create($request);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Creëren van gilde mislukt, error: '. $e->getMessage());
        }

        try {
            Mail::to($create['user'])->send(new newUser($create['user'], $create['password']));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Mailen van gilde mislukt, error: '. $e->getMessage());
        }

        return redirect()->back()->with('succes', 'Succesvol gilde aangemaakt');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric'
        ]);

        $gilde = $this->gildeService->read($request->id);

        try {
            Mail::to($gilde)->send(new deleteUser($gilde));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Mailen van gilde mislukt, error: '. $e->getMessage());
        }

        try {
            $this->gildeService->delete($request->id);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Verwijderen van gilde mislukt, error: '. $e->getMessage());
        }

        return redirect()->back()->with('succes', 'Succesvol gilde verwijderd');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newPassword(Request $request)
    {
//        $this->validate($request, [
//            'id' => 'required|numeric'
//        ]);
//
//        return $this->gildeService->newPassword($request->id);
        return redirect()->back()->with('error', 'Dit kunnen de gilde zelf door naar ' . route('NieuwWachtwoordGildeGET') . ' te gaan.');
    }

    public function changeMail(Request $request, Gilde $id)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('gilde')->ignore($id->id),
            ]
        ]);

        $mails = [$id->email, $request->email];

        try {
            $this->gildeService->update($request, $id->id);
        } catch (Exception $e) {
            return back()->with('error' , 'Niet opgeslagen, probeer opnieuw!, Error: ' .  $e->getMessage());
        }

        try {
            Mail::to($mails)->send(new changeMail($id));
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => 'Email is niet naar gilde verzonden ' . $e->getMessage()]);
        }

        return redirect()->back()->with('succes', 'Gegevens geüpdate');
    }
}

