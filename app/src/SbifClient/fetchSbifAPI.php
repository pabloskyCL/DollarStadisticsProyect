<?php

namespace App\SbifClient;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class fetchSbifAPI
{
    private ContainerBagInterface $params;

    public function __construct(ContainerBagInterface $params)
    {
        $this->params = $params;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function dollarValuesByMonth(HttpClientInterface $httpClient, $date){

        $month = $date['month'];
        $year = $date['year'];
        $apiKey = $this->params->get('app.sbifAPIKEY');
        $sbifURL = $this->params->get('app.sbifAPIURL');
        $sbifRequest = $httpClient->request('GET',$sbifURL.$year.'/' . $month, [
            'query' => [
                'apikey' => $apiKey,
                'formato' => 'JSON'
            ]
        ]);

        try {
            $apiResponse = json_decode($sbifRequest->getContent(), true);
        } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface $e) {
            $apiResponse = [
                'error'=> 'Ha ocurrido un error'
            ];
        }
        return $apiResponse['Dolares'];
    }
}