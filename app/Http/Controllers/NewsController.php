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

    public function index(){
        $news = NewsModel::paginate(6);
        $page = 'manajemen-berita';
        $title = 'Manajemen Berita';
        return view('admin._news.index',compact('news', 'title', 'page'));
    }

    // public function indexUser(){
    //     return view('landingpage');
    //     $news = NewsModel::all();
    //     $page = 'Manajemen Berita';
    //     return view('admin._news.index', ['page' => $page, 'news' => $news]);
    // }

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

    public function indexUser()
    {
        $news = NewsModel::all();
        $event = EventModel::all();
        $page = 'Daftar Berita';
        return view('landingpage', ['page' => $page, 'news' => $news, 'event' => $event]);
    }

}
