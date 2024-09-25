<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class Popclock extends Controller
{
    public function scrape()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://siperindu.online/popclocksulbar');
        $html = (string) $response->getBody();
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $titles = [];
        foreach ($dom->getElementsByTagName('h1') as $node) {
            $titles[] = $node->textContent;
        }
        //dd($titles[0]);
        return view('content.popclock', ['titles' => $titles]);
    }
}
