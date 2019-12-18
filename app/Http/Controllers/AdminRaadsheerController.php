<?php

namespace App\Http\Controllers;

use App\Formonderdeel;
use App\Services\RaadsheerService;
use Exception;
use Illuminate\Http\Request;
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
            $this->raadsheerservice->create($request);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e]);
        }
        return redirect()->back()->with(['succes' => 'Success']);
    }

    public function delete($id)
    {
        if ($this->idValidator($id)->fails()){
            return redirect()->back()->withErrors($this->idValidator($id));
        }

        $this->raadsheerservice->delete($id);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        if ($this->idValidator($id)->fails()){
            return redirect()->back()->withErrors($this->idValidator($id));
        }

        try {
            $this->raadsheerservice->update($request, $id);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e]);
        }

        return redirect()->back()->with(['succes' => 'Succes']);
    }

    public function newPassword($id)
    {
        if ($this->idValidator($id)->fails()){
            return redirect()->back()->withErrors($this->idValidator($id));
        }

        try {
            $password = $this->raadsheerservice->newPassword($id);
        } catch (Exception $e){
            return redirect()->back()->with(['error' => $e]);
        }

        // TODO: Mail new password
        return redirect()->back()->with(['succes' => 'New password send, password: ' . $password]);
    }

    private function idValidator($id){
        return Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:raadsheer'
        ]);

    }
}
