<?php

namespace App\Http\Controllers;

use App\Contracts\EventContract;
use App\Http\Requests\EventRequest;
use App\Models\EventModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    //
    protected EventContract $eventContract;

    public function __construct(EventContract $eventContract)
    {
        $this->eventContract = $eventContract;
    }

    public function index()
    {
        $event = EventModel::all();
        return view('admin._event.index', compact('event'));
        //jangan lupa menyesuaikan nama view
    }

    public function add()
    {
        return view('admin._event.add');
        //jangan lupa menyesuaikan nama view
    }

    public function storeNews(EventRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->eventContract->storeEvent($validated);

        return redirect()->route('manajemen-acara')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function editNews(EventModel $news): View
    {
        return view('admin._event.edit', compact('news'));
    }

    public function updateNews(EventRequest $request, EventModel $news): RedirectResponse
    {
        $validated = $request->validated();
        $this->eventContract->updateEvent($validated, $news);

        return redirect()->route('manajemen-acara')->with('success', 'Berita berhasil diperbarui.');
    }

    public function deleteNews(EventModel $news): RedirectResponse
    {
        $this->eventContract->deleteEvent($news);

        return redirect()->route('manajemen-acara')->with('success', 'Berita berhasil di hapus.');
    }
}
