<?php

namespace App\Http\Controllers;

use App\Formonderdeel;
use App\Mail\newPassword;
use App\Mail\newUser;
use App\Mail\raadsheerNewPassword;
use App\Raadsheer;
use App\Services\RaadsheerService;
use Exception;
use Illuminate\Http\Request;
use Mail;
use Validator;

class AdminRaadsheerController extends Controller
{
    protected $raadsheerservice;

    public function __construct(RaadsheerService $raadsheerService)
    {
        $this->raadsheerservice = $raadsheerService;
    }

    public function index()
    {
        return view('admin.raadsheer')->with(['raadsheren' => $this->raadsheerservice->index(), 'onderdelen' => Formonderdeel::all()]);
//        return $this->raadsheerservice->index();
    }

    public function create(Request $request)
    {
        try {
            $create = $this->raadsheerservice->create($request);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        Mail::to($create['raadsheer'])->send(new newUser($create['raadsheer'], $create['password']));
        dump($create['raadsheer']);
        return redirect()->back()->with(['succes' => 'Success']);
    }

    public function delete($id)
    {
        if ($this->idValidator($id)->fails()){
            return redirect()->back()->withErrors($this->idValidator($id));
        }
        try {
            $this->raadsheerservice->delete($id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        return redirect()->back()->with(['succes' => 'Succesvol!']);
    }

    public function update(Request $request, $id)
    {
        if ($this->idValidator($id)->fails()){
            return redirect()->back()->withErrors($this->idValidator($id));
        }

        try {
            $this->raadsheerservice->update($request, $id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        return redirect()->back()->with(['succes' => 'Succes']);
    }

    public function newPassword(Raadsheer $id)
    {
        if ($this->idValidator($id->id)->fails()){
            return redirect()->back()->withErrors($this->idValidator($id->id));
        }

        try {
            $password = $this->raadsheerservice->newPassword($id->id);
        } catch (Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

        Mail::to($id)->send(new newPassword($id, $password));

        return redirect()->back()->with(['succes' => 'New password send, password: ' . $password]);
    }

    private function idValidator($id){
        return Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:raadsheer'
        ]);

    }
}
