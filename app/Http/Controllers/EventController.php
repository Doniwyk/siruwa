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
        try {
            $event = EventModel::all();
            $title = 'Manajemen Agenda';
            return view('admin._event.index', [compact('event'), 'page' => $title]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data agenda tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function add()
    {
        return view('admin._event.add');
    }

    public function storeEvent(EventRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->eventContract->storeEvent($validated);
            return redirect()->route('admin.manajemen-acara.index')->with('success', 'Berita berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan agenda' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function editEvent(EventModel $news): View
    {
        return view('admin._event.edit', compact('news'));
    }

    public function updateEvent(EventRequest $request, EventModel $news): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->eventContract->updateEvent($validated, $news);
            return redirect()->route('admin.manajemen-acara.index')->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah agenda' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function deleteEvent(EventModel $news): RedirectResponse
    {
        try {
            $this->eventContract->deleteEvent($news);
            return redirect()->route('admin.manajemen-acara.index')->with('success', 'Berita berhasil di hapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus agenda' . $e->getMessage())->withErrors([$e->getMessage()]);

        }
    }
}
