<?php

namespace App\Interfaces;

interface ICsvInterface {
    function createCsvDollarValuesByMonth(array $dollarValueList);
}