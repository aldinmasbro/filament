<?php

namespace App\Http\Controllers;

use App\Models\HeroSubTitle;
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

        if (count($titles) >= 3) {
            $dataPenduduk = $titles[0];
            $dataKelahiran = $titles[1];
            $dataKematian = $titles[2];
        
            $titles[0] = 'Jumlah Penduduk Saat Ini : ' . $dataPenduduk;
            $titles[1] = 'Jumlah Kelahiran Tahun Ini : ' . $dataKelahiran;
            $titles[2] = 'Jumlah Kematian Tahun Ini : ' . $dataKematian;
        }

        HeroSubTitle::where('hero_id', 2)->delete();

        foreach ($titles as $title) {
            HeroSubTitle::create([
                'hero_id' => 2, // Pastikan hero_id sesuai
                'text' => $title,
            ]);
        }

        return $titles;
    }
}
