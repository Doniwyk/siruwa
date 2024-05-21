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

    public function index(Request $request){

        $typeDocument = $request->query('typeDocument', 'berita');
        $search = $request->query('search', '');
        $order = $request->query('order', 'asc');

        $news = $this->getFilterNews($search, $order);


        $paginationHtml = $news->appends([
            'typeDocument' => $typeDocument,
            'search' => $search,
            'order' => $order
        ])->links()->toHtml();

        $page = 'manajemen-berita';
        $title = 'Manajemen Berita';

        if ($request->wantsJson()) {
            return [
                'news' => $news->items(),
                'paginationHtml' => $paginationHtml
            ];
        }
        
        return view('admin._news.index',compact('news','paginationHtml', 'title', 'page', 'typeDocument', 'search', 'order'));
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

    public function getFilterNews($search, $order){
        $news = NewsModel::where('judul', 'like', $search.'%')->orderBy('judul', $order);
        return $news->paginate(6);
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
