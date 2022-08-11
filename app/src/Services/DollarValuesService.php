<?php

namespace App\Services;

use App\Interfaces\IDollarInterface;
use App\Repository\DollarValueRepository;

class DollarValuesService implements IDollarInterface {

    private DollarValueRepository $dollarValueRepository;

    public function __construct(DollarValueRepository $dollarValueRepository)
    {
        $this->dollarValueRepository = $dollarValueRepository;
    }

    /**
     * @throws \Exception
     */
    function dollarValuesByMonth($date): array
    {
        $formatedDate = new \DateTime($date['year'].'-'.$date['month'].'-'.'04');
        return $this->dollarValueRepository->findBy(['date'=>$formatedDate]);
    }
}