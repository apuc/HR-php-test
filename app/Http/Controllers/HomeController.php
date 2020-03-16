<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Погода
     */
    public function weather()
    {
        $client = new Client();

        $response = $client->get('https://api.weather.yandex.ru/v1/forecast',[
            'query' => [
                'lat' => 53,
                'lon' => 34,
                'lang' => 'ru_RU',
            ],
            'headers' => [
                'X-Yandex-API-Key'=>'d5528c32-549b-4d79-8253-bf50181d2e52'
            ]
        ]);

        $temp = json_decode($response->getBody())->fact->temp;

        return view('weather.temp',compact('temp'));
    }
}
