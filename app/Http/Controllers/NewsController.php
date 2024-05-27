<?php

namespace App\Http\Controllers;

use App\Contracts\EventContract;
use App\Contracts\NewsContract;
use App\Http\Requests\EditNewsRequest;
use App\Models\EventModel;
use App\Models\NewsModel;
use App\Models\UserModel;
use Auth;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    protected NewsContract $newsContract;
    protected EventContract $eventContract;
    private $pageName;

    public function __construct(NewsContract $newsContract, EventContract $eventContract)
    {
        $this->newsContract = $newsContract;
        $this->eventContract = $eventContract;
        $this->pageName = 'manajemen-berita';
    }

    //===========================FOR ADMIN============================


    public function index(Request $request)
    {

        $typeDocument = $request->query('typeDocument', 'berita');
        $search = $request->query('search', '');
        $order = $request->query('order', 'asc');

        $lastestEvent = $this->getLastestEvent($search, 'desc', 2);
        $lastestNews = $this->getLastestNews($search, 'desc', 2);

        switch ($typeDocument) {
            case 'berita':
                $news = $this->getFilterNews($search, $order);
                break;

            case 'acara':
                $news = $this->getFilterEvent($search, $order);
                break;
        }

        // dd($news[0]->judul);

        $paginationHtml = $news->appends([
            'typeDocument' => $typeDocument,
            'search' => $search,
            'order' => $order
        ])->links()->toHtml();


        $page = $this->pageName;
        $title = 'Manajemen Berita';

        if ($request->wantsJson()) {
            return [
                'news' => $news->items(),
                'paginationHtml' => $paginationHtml
            ];
        }

        return view('admin._news.index', compact('news', 'paginationHtml', 'title', 'page', 'typeDocument', 'search', 'order', 'lastestEvent', 'lastestNews'));
    }


    public function add()
    {
        $page = $this->pageName;
        $title = 'Manajemen Berita';
        $userId = Auth::id();
        $account = UserModel::findOrFail($userId);
        return view('admin._news.create', compact('page', 'title', 'account'));
    }

    public function storeNews(Request $request)
    {
        try {
            $image = $request->file('image');
            $admin = Auth::id();
    
            $cloudinaryImage = $image->storeOnCloudinary('berita');
            $url = $cloudinaryImage->getSecurePath();
            $publicId = $cloudinaryImage->getPublicId();

            $imageUpload = NewsModel::create([
                'url_gambar' => $url,
                'image_public_id' => $publicId,
                'judul' => $request->input('judul'),
                'id_admin' => $admin,
                'isi' => $request->input('editor')
            ]);
            $imageUpload->save();
            return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil ditambahkan.');
        } catch (\Exception $e) {
            return dd($e);
        }

    }

    public function editNews(NewsModel $news)
    {
        $page = $this->pageName;
        $title = 'Manajemen Berita';
        $userId = Auth::id();
        $account = UserModel::findOrFail($userId);
        return view('admin._news.edit', compact('title', 'page','news', 'account'));
    }

    public function updateNews(EditNewsRequest $request, NewsModel $news)
    {
        $validated = $request->validated();
        try {
            $this->newsContract->updateNews($validated, $news);
            return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Gagal megubah berita' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function deleteNews(NewsModel $news)
    {
        try {
            $this->newsContract->deleteNews($news);
            return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil di hapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus berita' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }


    public function getFilterNews($search, $order)
    {
        $news = NewsModel::where('judul', 'like', $search . '%')->orderBy('judul', $order);
        return $news->paginate(6);
    }
    public function getFilterEvent($search, $order)
    {
        $event = EventModel::where('judul', 'like', $search . '%')->orderBy('judul', $order);
        return $event->paginate(6);
    }
    public function getLastestNews($search, $order, $count)
    {
        $news = NewsModel::where('judul', 'like', $search . '%')->orderBy('judul', $order)->take($count)->get();
        return $news;
    }
    public function getLastestEvent($search, $order, $count)
    {
        $event = EventModel::where('judul', 'like', $search . '%')->orderBy('judul', $order)->take($count)->get();
        return $event;
    }

    //===========================FOR RESIDENT============================

    public function indexResident()
    {
        try {
            $news = NewsModel::all();
            $event = EventModel::all();
            $latestNews = NewsModel::orderBy('created_at', 'desc')->take(3)->get();
            return view('landingpage', ['title' => 'Daftar Berita', 'news' => $news, 'event' => $event, 'latestNews' => $latestNews]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data berita tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }
}