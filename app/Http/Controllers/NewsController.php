<?php

namespace App\Http\Controllers;

use App\Contracts\NewsContract;
use App\Http\Requests\NewsRequest;
use App\Models\EventModel;
use App\Models\NewsModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    //
    protected NewsContract $newsContract;

    public function __construct(NewsContract $newsContract) {
        $this->newsContract = $newsContract;
    }

    //===========================FOR ADMIN============================

    public function index(){
        $news = NewsModel::paginate(6);
        $title = 'Manajemen Berita';
        return view('landingpage',compact('news', 'title'));
    }


    public function add(){
        return view('admin._news.add');
    }

    public function storeNews(NewsRequest $request):RedirectResponse{
        $validated = $request->validated();
        $this->newsContract->storeNews($validated);
        return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil ditambahkan.');    
    }

    public function editNews(NewsModel $news):View{
        return view('admin._news.edit', compact('news'));
    }

    public function updateNews(NewsRequest $request, NewsModel $news):RedirectResponse{
        $validated = $request->validated();
        $this->newsContract->updateNews($validated, $news);
        return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil diperbarui.');    
    }

    public function deleteNews(NewsModel $news):RedirectResponse{
        $this->newsContract->deleteNews($news);
        return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil di hapus.');
    }

        //===========================FOR RESIDENT============================
    public function indexResident()
    {
        $news = NewsModel::all();
        $event = EventModel::all();
        $latestNews = NewsModel::orderBy('created_at', 'desc')->take(3)->get();
        return view('landingpage', ['title' => 'Daftar Berita', 'news' => $news, 'event' => $event, 'latestNews'=>$latestNews]);
    }

}
