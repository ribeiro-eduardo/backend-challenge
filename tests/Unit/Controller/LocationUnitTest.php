<?php

use PHPUnit\Framework\Testcase;
use App\Repository\LocationRepository;

class LocationUnitTest extends \PHPUnit\Framework\TestCase 
{
    public function testShow()
    {   
        $locationRepo = $this->createMock(LocationRepository::class);
        $locationId = 3;

        $expectedLocation = '
        {
            "data": {
                "id": 3,
                "name": "San FranciscoSFO-12"
            }
        }';

        $locationRepo->method('find')->willReturn($expectedLocation);

        $this->assertEquals($expectedLocation, $locationRepo->find($locationId));
    }
}
