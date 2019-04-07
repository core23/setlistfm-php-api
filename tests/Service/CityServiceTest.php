<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\SetlistFm\Tests\Service;

use Core23\SetlistFm\Builder\CitySearchBuilder;
use Core23\SetlistFm\Connection\ConnectionInterface;
use Core23\SetlistFm\Service\CityService;
use PHPUnit\Framework\TestCase;

class CityServiceTest extends TestCase
{
    private $connection;

    protected function setUp()
    {
        $this->connection =  $this->prophesize(ConnectionInterface::class);
    }

    public function testItIsInstantiable(): void
    {
        $service = new CityService($this->connection->reveal());

        $this->assertNotNull($service);
    }

    public function testGetCity(): void
    {
        $this->connection->call('city/5357527')
            ->willReturn(json_decode(
                <<<'EOD'
                        {
                          "id" : "5357527",
                          "name" : "Hollywood",
                          "stateCode" : "CA",
                          "state" : "California",
                          "coords" : {
                            "long" : -118.3267434,
                            "lat" : 34.0983425
                          },
                          "country" : {
                            "code" : "US",
                            "name" : "United States"
                          }
                        }
                EOD
            ,
                true
            ))
        ;

        $service = new CityService($this->connection->reveal());
        $result  = $service->getCity(5357527);

        $this->assertNotNull($result);
    }

    public function testSearch(): void
    {
        $this->connection->call('search/cities', ['p' => 1, 'name' => 'Hollywood'])
            ->willReturn(json_decode(
                <<<'EOD'
                   {
                     "cities" : [ {
                       "id" : "5357527",
                       "name" : "Hollywood",
                       "stateCode" : "CA",
                       "state" : "California",
                       "coords" : {
                         "long" : -118.3267434,
                         "lat" : 34.0983425
                       },
                       "country" : {
                         "code" : "US",
                         "name" : "United States"
                       }
                     } ],
                     "total" : 1,
                     "page" : 1,
                     "itemsPerPage" : 20
                   }
                EOD
                ,
                true
            ))
        ;

        $service = new CityService($this->connection->reveal());
        $result  = $service->search(CitySearchBuilder::create()
            ->withName('Hollywood'));

        $this->assertCount(1, $result);
    }
}