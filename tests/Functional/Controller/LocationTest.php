<?php

use PHPUnit\Framework\Testcase;
use App\Infrastructure\dto\FilterDTO;

class LocationTest extends \PHPUnit\Framework\TestCase 
{
    public function testGetAllLocations()
    {
        $fakeLocation = $this->createMock(\App\Repository\LocationRepository::class);
        
        $locations = '{
            "data": [
                {
                    "id": 1,
                    "name": "AmsterdamAMS-01"
                },
                {
                    "id": 2,
                    "name": "Washington D.C.WDC-01"
                },
                {
                    "id": 3,
                    "name": "San FranciscoSFO-12"
                },
                {
                    "id": 4,
                    "name": "SingaporeSIN-11"
                },
                {
                    "id": 5,
                    "name": "DallasDAL-10"
                },
                {
                    "id": 6,
                    "name": "FrankfurtFRA-10"
                },
                {
                    "id": 7,
                    "name": "Hong KongHKG-10"
                }
            ]
        }';

        $fakeLocation->method('findAll')->willReturn($locations);

        $this->assertEquals($locations, $fakeLocation->findAll());
    }
}
