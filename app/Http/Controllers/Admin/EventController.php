<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $url = route('admin.event.store');
        return view('admin.event.form', compact('url'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
            'location' => 'string|required',
            'date' => 'required|date_format:d/m/Y',
        ]);
    
        $data['slug'] = Str::slug($request->title);
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date']);
        $data['location'] = $request->location;
    
        $event = Event::create($data);
    
        toast('Your event has been submitted!', 'success');
        return redirect()->route('admin.event.index');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return view('admin.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $url = route('admin.event.update', $event->id);
        return view('admin.event.form', compact('url', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $event = Event::findOrFail($id);
        $data = $request->validate([
            'title' => 'string|required',
            'description' => 'string|nullable',
            'date' => 'required|date_format:d/m/Y',
            'location' => 'string|required',
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['date'] = Carbon::createFromFormat('d/m/Y', $data['date']);
        $data['location'] = $request->location;
        $event->update($data);

        toast('Your event has been updated!','success');
        return redirect()->route('admin.event.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        toast('Your event has been deleted!','success');
        return redirect()->route('admin.event.index');
    }

    public function imageStore(Request $request, $id)
    {
        // dd($request->all());
        $event = Event::findOrFail($id);

        if ($request->has('images')) {
            $event->addMultipleMediaFromRequest(['images'])
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
