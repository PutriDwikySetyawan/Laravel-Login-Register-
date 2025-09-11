<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('settings.index'); // bikin file resources/views/settings/index.blade.php
    }

    public function update(Request $request)
    {
        // proses update setting
    }
}
