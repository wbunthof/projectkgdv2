<?php

namespace App\Http\Controllers;

use App\Setting;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings')->with([
            'settings' => Setting::all()
        ]);
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'required'
        ]);

        try {
            $setting->update($request->all());
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Opgeslagen!');
    }
}
