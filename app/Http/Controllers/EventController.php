<?php

namespace App\Http\Controllers;

use App\Contracts\EventContract;
use App\Http\Requests\EditEventRequest;
use App\Http\Requests\EventRequest;
use App\Models\EventModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    //
    protected EventContract $eventContract;
    private $pageName;

    public function __construct(EventContract $eventContract)
    {
        $this->eventContract = $eventContract;
        $this->pageName = 'manajemen-berita';
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
        try{
        $page = $this->pageName;
        $title = 'Tambah Agenda';
        $userId = Auth::id();
        $account = UserModel::findOrFail($userId);
        return view('admin._event.create', compact('page', 'title', 'account'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Tidak dapat memuat form tambah agenda' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function storeEvent(EventRequest $request)
    {
        try {
            if($request->action == 'upload'){
                $status = 'Uploaded';
            }else{
                $status = 'Draft';
            }

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
                'status' =>  $status
            ]);
            $imageUpload->save();
            return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil ditambahkan.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Tidak dapat menambahkan agenda' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function editEvent(EventModel $event)
    {
        try{
        $page = $this->pageName;
        $title = 'Edit Agenda';
        $userId = Auth::id();
        $account = UserModel::findOrFail($userId);
        return view('admin._event.edit', compact('title', 'page','event', 'account'));
        } catch(\Exception $e){
            return redirect()->back()->with('error', 'Tidak dapat memuat data agenda' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
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

    public function changeStatus(Request $request, EventModel $event){
        $action = $request->action;
        try {
            if($action == 'upload'){
                $event->status = 'Uploaded';
                $event->save();
            }else{
                $event->status = 'Draft';
                $event->save();
            }
            return redirect()->route('admin.manajemen-acara.index')->with('success', 'Update berhasil.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update agenda' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}
