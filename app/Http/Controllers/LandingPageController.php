<?php

namespace App\Http\Controllers;

use App\Models\Hero;
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
            return view('layout.web', compact(
                'hero',
        ));
        // $hero = \App\Models\Hero::where('is_active', true)->first();
        // [$mainTitle, $animationTitle] = explode('#', $hero->title);
        // $animationTitle = explode('|', $animationTitle);

        //get all services order by ascending
        // $services = \App\Models\Service::orderBy('position', 'asc')->get();
        //get 10 portfolio order by descending
        // $portfolios = \App\Models\Portfolio::orderBy('created_at', 'desc')->take(10)->get();



        // return view(
        //     'welcome',
        //     compact(
        //         'hero',
        //         'mainTitle',
        //         'animationTitle',
        //         'services',
        //         'portfolios'
        //     )
        // );
    }
}
