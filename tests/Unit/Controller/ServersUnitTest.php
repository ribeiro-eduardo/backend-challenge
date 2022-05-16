<?php

use PHPUnit\Framework\Testcase;
use App\Infrastructure\dto\FilterDTO;
use App\tests\Repository\ServerRepositoryTest;
use App\Repository\ServerRepository;
use Doctrine\Persistence\ObjectRepository;

class ServersUnitTest extends \PHPUnit\Framework\TestCase 
{
    public function testShow()
    {   
        $serverRepo = $this->createMock(ServerRepository::class);
        $serverId = 980;

        $expectedServer = '
        {
            "data": {
                "id": 980,
                "model": "Dell R210-IIIntel Xeon E3-1230v2",
                "ram": "16GBDDR3",
                "hdd": "2x2TBSATA2",
                "location": "AmsterdamAMS-01",
                "price": "€72.99",
                "currency": "€",
                "disksQty": 2,
                "diskCapacity": 2,
                "capacityUnity": "TB",
                "diskType": "SATA2",
                "memoryQty": 16,
                "memoryClass": "DDR3"
            }
        }';

        $serverRepo->method('find')->willReturn($expectedServer);

        $this->assertEquals($expectedServer, $serverRepo->find($serverId));
    }
}
