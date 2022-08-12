<?php

namespace App\Services;

use App\Interfaces\IDollarInterface;
use App\Repository\DollarValueRepository;
use Exception;

class DollarValuesService implements IDollarInterface {

    private DollarValueRepository $dollarValueRepository;

    public function __construct(DollarValueRepository $dollarValueRepository)
    {
        $this->dollarValueRepository = $dollarValueRepository;
    }

    /**
     * @throws Exception
     */
    function dollarValuesByMonth($date): array
    {
        $firstDayOfTheMonth = new \DateTime($date['year'].'-'.$date['month'].'-'.'01');
        $lastDayOfTheMonth = new \DateTime($date['year'].'-'.$date['month'].'-'.'31');
        $DollarValues = $this->dollarValueRepository->getDollarValuesByMonth($firstDayOfTheMonth,$lastDayOfTheMonth);
        $formatedData = [];
        foreach ($DollarValues as $dollarValue){
            $formatedData[] = ['Valor'=>$dollarValue->getValor(),'Fecha'=>date_format($dollarValue->getDate(),'Y-m-d')];
        }
        return $formatedData;
    }
}