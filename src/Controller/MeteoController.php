<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MeteoController extends AbstractController
{
    #[Route('/meteo', name: 'meteo')]
    public function index(Request $request): Response
    {
        $url = 'http://api.openweathermap.org/data/2.5/weather?q=paris&appid=902dc3bb337a0fba35d5043e139dbc11';
        $obj = json_decode(file_get_contents($url), true);

        return $this->render('site/show.html.twig', [
            'wind_speed' => $obj['wind']['speed'],
            // 'temperature min'=>$obj['temp_min'],
            // 'humidity': TODO
            // etc..
        ]);
    }
}
