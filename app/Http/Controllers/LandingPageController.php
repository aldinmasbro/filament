<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Team;
use App\Models\Client;
use App\Models\Service;
//use GuzzleHttp\Popclock;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LandingPageController extends Controller
{
    //
    public function index()
    {
        $popclock = new Popclock();
        $popclock->scrape();
        
        //get one hero that is active
        $hero = Hero::where('is_active', true)
            ->with('heroSubTitles')
            ->first();
        //dd($hero);

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

        return view(
            'layout.web',
            compact(
                'hero',
                'services',
                'portfolios',
                'clients',
                'teams',

            )
        );
    }
}
