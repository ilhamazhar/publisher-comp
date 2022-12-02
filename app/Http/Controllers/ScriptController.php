<?php

namespace App\Http\Controllers;

use App\Models\Script;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScriptController extends Controller
{
    public function index()
    {
        $content = [
            'scripts' => Script::paginate(10),
            'statuses' => Status::all(),
        ];

        return view('scripts.index', $content);
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
            'doc' => ['required', 'mimes:pdf']
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

        activity()->event('success')->log('Menambahkan data naskah');

        toast('Naskah telah ditambahkan', 'success');

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
        if ($request->user()->role_id == 1) {
            $script->update(['status_id' => $request->status_id]);
        } else {
            Validator::make($scripts, [
                'authors' => ['required'],
                'email' => ['required', 'email', 'unique:scripts,email,' . $script->id],
                'phone' => ['required', 'numeric', 'unique:scripts,phone,' . $script->id],
                'head' => ['required'],
                // 'doc' => ['required', 'mimes:pdf']
            ])->validate();

            $script->update([
                'authors' => $request->authors,
                'email' => $request->email,
                'phone' => $request->phone,
                'head' => $request->head,
            ]);
        }

        toast('Naskah telah diubah', 'success');

        return redirect()->route('scripts.index');
    }

    public function show(Script $script)
    {
        $this->authorize('view', $script);

        return view('scripts.show', compact('script'));
    }

    public function destroy(Script $script)
    {
        $this->authorize('delete', $script);

        $script->delete();

        toast('Data telah dihapus', 'error');

        return redirect()->route('scripts.index');
    }

    public function birtday()
    {
        $this->authorize('viewAny', Script::class);

        $birtday = Script::whereNotBetween('created_at', [Carbon::now()->subYear(), Carbon::now()])->get();

        return view('scripts.birtday', compact('birtday'));
    }
}
