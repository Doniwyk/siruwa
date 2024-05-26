<?php

namespace App\Http\Controllers;

use App\Contracts\DashboardContract;
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
            return view('landingpage', ['title' => 'Daftar Berita', 'news' => $news, 'event' => $event, 'latestNews' => $latestNews]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data berita tidak ditemukan ' . $e->getMessage())->withErrors([$e->getMessage()]);
        }
    }

    public function indexOrStructure(){
        return view('admin._dashboard.index');
    }

    public function update(Request $request, OrStructureModel $structure){

        try {
            $validated = $request->validated();
            $this->dashboardContract->updateOrganizationStructure($validated, $structure);
            return redirect()->route('admin.manajemen-berita.index')->with('success', 'Berita berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal megubah berita' . $e->getMessage())->withErrors([$e->getMessage()]);
        }

    }



}
