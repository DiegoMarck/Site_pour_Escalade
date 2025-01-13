<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


class MeteoController extends AbstractController
{// @Route("site/{id}", name="site_show")
    /**
     *
     *  @Route("/meteo", name="meteo")
     */
    public function indexAction(Request $request)
    {
        // $url = 'http://api.openweathermap.org/data/2.5/weather?q='.$_GET['q'].'&APPID=902dc3bb337a0fba35d5043e139dbc11';
        // $url = 'http://api.openweathermap.org/data/2.5/weather?lat={lat}&lon={lon}&appid=902dc3bb337a0fba35d5043e139dbc11';
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
