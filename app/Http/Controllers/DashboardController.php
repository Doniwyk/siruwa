<?php

namespace App\Http\Controllers;

use App\Contracts\DashboardContract;
use App\Models\DataDashboardModel;
use App\Models\EventModel;
use App\Models\NewsModel;
use App\Models\OrStructureModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected DashboardContract $dashboardContract;

    public function __construct(DashboardContract $dashboardContract)
    {
        $this->dashboardContract = $dashboardContract;
    }

    //
    public function indexLandingPage()
    {
        try {
            $news = NewsModel::all();
            $event = EventModel::all();
            $latestNews = NewsModel::orderBy('created_at', 'desc')->take(3)->get();
            $dataDashboard = $this->dashboardContract->dataDashboard();
            return view('landingpage', ['title' => 'Daftar Berita', 'news' => $news, 'event' => $event, 'latestNews' => $latestNews, 'dataDashboard'=>$dataDashboard]);
        } catch (\Exception $e) {
            dd($e);
            // return redirect()->back()->with('error', 'Data berita tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    //To manajemen organixation structure for admin
    public function manajemenDashboard(){
        try{
            $title = 'Manajemen Dashboard';
            $page='dashboard';
            $dataDashboard = $this->dashboardContract->dataDashboard(); 
            $residentTotal = $dataDashboard['resident'];
            $rwData = $dataDashboard['data'][0];
            return view('admin._dashboard.index', compact('title', 'page', 'residentTotal', 'rwData'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function updateDashboardData(Request $request, DataDashboardModel $data){
        try {
            $this->dashboardContract->updateDashboardData($request, $data);
            return redirect()->route('admin.manajemen-dashboard.index')->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal megubah data' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }
}
