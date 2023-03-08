<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreAcademicRequest;
use App\Http\Requests\UpdateAcademicRequest;
use App\Models\Academic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Event;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class AcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academics = Academic::all();
        return view('admin.academic.index', compact('academics'));
    }

    public function index2()
    {
        $academics = Academic::all();
        return view('admin.academic.index2', compact('academics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.academic.store');
        return view('admin.academic.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
        ]);

        $data['slug'] = Str::slug($request->title);
        $academic = Academic::create($data);

        toast('Your academic has been submitted!', 'success');
        return redirect()->route('admin.academic.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $academic = Academic::findOrFail($id);
        return view('admin.academic.show', compact('academic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $academic = Academic::findOrFail($id);
        $url = route('admin.academic.update', $academic->id);
        return view('admin.academic.form', compact('url', 'academic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
        ]);

        $data['slug'] = Str::slug($request->title);
        $academic = Academic::findOrFail($id);
        $academic->update($data);

        toast('Your academic has been updated!', 'success');
        return redirect()->route('admin.academic.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academic $academic)
    {
        $academic->delete();
        toast('Your academic has been deleted!', 'success');
        return redirect()->route('admin.academic.index');
    }

    public function imageStore(Request $request, $id)
    {
        // dd($request->all());
        $academic = Academic::findOrFail($id);

        if ($request->has('images')) {
            $academic->addMultipleMediaFromRequest(['images'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('images');
            });
        }

        toast('Your Image has been uploaded!','success');
        return redirect()->back();

    }

    public function imageDestroy($image)
    {
        $media = Media::findOrFail($image);
        $media->delete();

        toast('Your Image has been deleted', 'success');
        return redirect()->back();

    }
}
