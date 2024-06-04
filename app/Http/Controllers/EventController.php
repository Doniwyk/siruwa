<?php

namespace App\Http\Controllers;

use App\Contracts\EventContract;
use App\Http\Requests\EditEventRequest;
use App\Http\Requests\EventRequest;
use App\Models\EventModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //
    protected EventContract $eventContract;
    private $pageName;

    public function __construct(EventContract $eventContract)
    {
        $this->eventContract = $eventContract;
        $this->pageName = 'manajemen-acara';
    }

    public function index()
    {
        try {
            $page = $this->pageName;
            $event = EventModel::all();
            $title = 'Manajemen Agenda';
            return view('admin._event.index', compact('event', 'page'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data agenda tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function add()
    {
        $page = $this->pageName;
        $title = 'Tambah Agenda';
        $userId = Auth::id();
        $account = UserModel::findOrFail($userId);
        return view('admin._event.create', compact('page', 'title', 'account'));
    }

    public function storeEvent(EventRequest $request)
    {
        try {
            $image = $request->file('image');
            $admin = Auth::id();
    
            $cloudinaryImage = $image->storeOnCloudinary('acara');
            $url = $cloudinaryImage->getSecurePath();
            $publicId = $cloudinaryImage->getPublicId();

            $imageUpload = EventModel::create([
                'url_gambar' => $url,
                'image_public_id' => $publicId,
                'judul' => $request->input('judul'),
                'id_admin' => $admin,
                'isi' => $request->input('isi'),
                'tanggal' => $request->input('tanggal'),
            ]);
            $imageUpload->save();
            return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil ditambahkan.');
        } catch (\Exception $e) {
            return dd($e);
        }
    }

    public function editEvent(EventModel $event)
    {
        $page = $this->pageName;
        $title = 'Edit Agenda';
        $userId = Auth::id();
        $account = UserModel::findOrFail($userId);
        return view('admin._event.edit', compact('title', 'page','event', 'account'));
    }

    public function updateEvent(EditEventRequest $request, EventModel $event)
    {
        try {
            $validated = $request->validated();
            $this->eventContract->updateEvent($validated, $event);
            return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengubah agenda' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function deleteEvent(EventModel $event)
    {
        try {
            $this->eventContract->deleteEvent($event);
            return redirect()->route('admin.manajemen-acara.index')->with('success', 'Berita berhasil di hapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus agenda' . $e->getMessage())->withErrors([$e->getMessage()]);

        }
    }
}
