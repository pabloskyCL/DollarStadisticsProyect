<?php

namespace App\Services;

use App\Interfaces\ICsvInterface;

class CsvService implements ICsvInterface
{

    function createCsvDollarValuesByMonth($dollarValueList)
    {
        $fcsv = fopen('dollarValues.csv', 'w');
        $csv = '';
        foreach ($dollarValueList as $line) {
            if (empty($header)) {
                $header = array_keys($line);
                fputcsv($fcsv, $header);
                $csv .= implode(',', $header);
                $header = array_flip($header);
            }

            $line_array = array();

            foreach ($line as $value) {
                $line_array[] = $value;
            }

            $csv .= "\n" . implode(',', $line_array);

            fputcsv($fcsv, $line_array);
        }
        fclose($fcsv);
    }
}