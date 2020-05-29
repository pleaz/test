<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\FileRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Vinkla\Hashids\Facades\Hashids;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function index()
    {
        $files = auth()->user()->files;
        return view('file.index', compact('files'));
    }

    public function create()
    {
        return view('file.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FileRequest $request)
    {
        $v = Validator::make($request->validated(), [
            'file' => 'mimes:exe,bmp,php',
        ]);

        $url = null;
        if ($v->fails()) {
            $f = request()->file;
            $filename = time().'.'.$f->getClientOriginalExtension();
            request()->file->move(public_path('files'), $filename);

            $file = auth()->user()->files()->create([
                'name' => pathinfo($f->getClientOriginalName() , PATHINFO_FILENAME),
                'src' => $filename
            ]);
            $url = url(route('file.show', ['file' => $file]));
        }

        return Redirect::back()->with('status', 'file saved: <a href="'.$url.'">'.$url.'</a>');
    }

    /**
     * Display the specified resource.
     *
     * @param $hash
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function show($hash)
    {
        $id = Hashids::decode($hash);
        $file = null;
        if($id) $file = File::where('id', $id)->first();

        return view('file.show')->with(compact('file'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($hash)
    {
        $id = Hashids::decode($hash);
        $file = null;
        if($id) $file = File::where('id', $id)->first();
        if($file) {
            \File::delete('files/'.$file->src);
            $file->delete();
        }

        return Redirect::back()->with('status', 'file deleted');
    }
}
