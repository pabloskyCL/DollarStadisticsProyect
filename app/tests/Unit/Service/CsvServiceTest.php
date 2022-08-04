<?php

namespace App\Tests\Unit\Service;


use App\Services\CsvService;
use PHPUnit\Framework\TestCase;

class CsvServiceTest extends TestCase{

    private CsvService $csvService;

    public function setUp(): void
    {
        parent::setUp();

        $this->csvService = new CsvService();
    }

    public function testCreateCsvDollarValuesByMonth() {

        $dollarValueList = [
            ['Valor'=>'4234',
             'Fecha'=> '12/32/21'],
            ['Valor'=>'5432',
                'Fecha'=>'23/43/21'],
            ['Valor'=> '5765',
                'Fecha'=>'12/23/21']
        ];

        $this->csvService->createCsvDollarValuesByMonth($dollarValueList);
        $this->assertTrue(file_exists('dollarValues.csv'));
    }

    public function testCsvFormatFile(){
        $dollarValues = [
            ['Valor' => '654.76',
            'Fecha' => '11/05/2019'],
            ['Valor' => '765.31',
            'Fecha' => '10/02/2020']
        ];
        ini_set('auto_detect_line_endings', TRUE);

        $this->csvService->createCsvDollarValuesByMonth($dollarValues);
//        $file = fopen('dollarValues.csv','r');
        $file = file('dollarValues.csv');
        $rows = array_map('str_getcsv', file('dollarValues.csv'));
        $header = array_shift($rows);
        $csvToArray = [];
        foreach($rows as $row){
            $csvToArray[] = array_combine($header, $row);
        }

        foreach ($csvToArray as $row){
            $this->assertArrayHasKey("Valor",$row);
            $this->assertArrayHasKey("Fecha", $row);
        }

    }

}