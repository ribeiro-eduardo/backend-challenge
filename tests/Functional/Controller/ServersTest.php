<?php

use PHPUnit\Framework\Testcase;
use App\Infrastructure\dto\FilterDTO;

class ServersTest extends \PHPUnit\Framework\TestCase 
{
    public function testFindServers()
    {
        $fakeServer = $this->createMock(\App\Repository\ServerRepository::class);

        $filterDTO = new FilterDTO('3TB', '72TB', '24, 32, 48, 64, 96', 'SSD', 'SingaporeSIN-11');
        
        $servers = '{
            "data": [
                {
                    "id": 1203,
                    "model": "Dell R6302x Intel Xeon E5-2630v4",
                    "ram": "64GBDDR4",
                    "hdd": "2x240GBSSD",
                    "location": "SingaporeSIN-11",
                    "price": "S$489.99",
                    "currency": "S",
                    "disks_qty": 2,
                    "disk_capacity": 240,
                    "capacity_unity": "GB",
                    "disk_type": "SSD",
                    "memory_qty": 64,
                    "memory_class": "DDR4"
                }
            ]
        }';

        $fakeServer->method('findByFilter')->willReturn($servers);

        $this->assertEquals($servers, $fakeServer->findByFilter($filterDTO));
    }
}
