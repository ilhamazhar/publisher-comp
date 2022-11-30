<?php

namespace App\Http\Controllers;

use App\Models\Script;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScriptController extends Controller
{
    public function index()
    {
        $scripts = Script::all();

        return view('scripts.index', compact('scripts'));
    }

    public function create()
    {
        $this->authorize('create', Script::class);

        return view('scripts.create');
    }

    public function store(Request $request)
    {
        $scripts = ($request->all());
        Validator::make($scripts, [
            'authors' => ['required'],
            'email' => ['required', 'email', 'unique:scripts,email'],
            'phone' => ['required', 'numeric', 'unique:scripts,phone'],
            'head' => ['required'],
            'doc' => ['required']
        ])->validate();

        $docName = $request->doc->getClientOriginalName();
        $request->file('doc')->storeAs('public/docs', time() . '-' . $docName);

        Script::create([
            'user_id' => $request->user()->id,
            'authors' => $request->authors,
            'email' => $request->email,
            'phone' => $request->phone,
            'head' => $request->head,
            'doc' => time() . '-' . $docName,
        ]);

        return redirect()->route('scripts.index');
    }

    public function edit(Script $script)
    {
        $this->authorize('update', $script);

        $content = [
            'statuses' => Status::all(),
            'script' => $script
        ];

        return view('scripts.edit', $content);
    }

    public function update(Request $request, Script $script)
    {
        $scripts = ($request->all());
        // dd($scripts);
        Validator::make($scripts, [
            'authors' => ['required'],
            'email' => ['required', 'email', 'unique:scripts,email,' . $script->id],
            'phone' => ['required', 'numeric', 'unique:scripts,phone,' . $script->id],
            'head' => ['required'],
            // 'doc' => ['required']
        ])->validate();

        $script->update([
            'authors' => $request->authors,
            'email' => $request->email,
            'phone' => $request->phone,
            'head' => $request->head,
            'status_id' => $request->status_id
        ]);

        return redirect()->route('scripts.index');
    }

    public function show(Script $script)
    {
        return view('scripts.show', compact('script'));
    }

    public function destroy(Script $script)
    {
        $this->authorize('delete', $script);

        $script->delete();

        return redirect()->route('scripts.index');
    }
}
