<?php


namespace App\Services;


use App\Interfaces\IDollarInterface;
use App\SbifClient\fetchSbifAPI;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class sbifAPIService implements IDollarInterface {

    private HttpClientInterface $httpClient;
    private fetchSbifAPI $fetchSbifAPI;

    public function __construct(HttpClientInterface $httpClient, fetchSbifAPI $fetchSbifAPI)
    {
        $this->httpClient = $httpClient;
        $this->fetchSbifAPI = $fetchSbifAPI;
    }

    /**
     * @throws TransportExceptionInterface
     */
    function dollarValuesByMonth($date)
    {
        return $this->fetchSbifAPI->dollarValuesByMonth($this->httpClient,$date);
    }
}