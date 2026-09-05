<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Analytics;
use App\Models\MovieModel;
use App\Models\SettingsModel;


class Dashboard extends BaseController
{
    public function index()
    {
        $title = 'Dashboard';

        $analytics = new Analytics();
        $anytc = $analytics->init()
                            ->getData();

        $movieModel = new MovieModel();
        $topMovies = $movieModel->movies()
                                ->where('views > ', 0)
                                ->orderBy('views', 'DESC')
                                ->findAll(10);

        $data = compact('title', 'anytc', 'topMovies');

        return view('admin/dashboard/index', $data);
    }
}
