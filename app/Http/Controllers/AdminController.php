<?php

namespace App\Http\Controllers;

use App\Models\Script;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $scripts = Script::all();
        return view('admin.index', compact('scripts'));
    }

    public function show(Script $script)
    {
        return view('scripts.show', compact('script'));
    }
}
