<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Hero;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    public function index()
    {
        //get one hero that is active
        $hero = Hero::where('is_active', true)
            ->with('heroSubTitles')
            ->first();

        //get all active service ordet by sort
        $services = Service::where('is_active', true)
            ->orderBy('sort')
            ->get();

        //get all active portofolio with category
        $portfolios = Portfolio::with('portfolioCategory')
            ->orderBy('sort')
            ->get();

        //get all clients
        $clients = Client::all();

        //get all teams with team social
        $teams = Team::with('teamSocials')
            ->get();
            //dd($teams);

        return view('layout.web', compact(
            'hero',
            'services',
            'portfolios',
            'clients',
            'teams',

        ));

    }
}
