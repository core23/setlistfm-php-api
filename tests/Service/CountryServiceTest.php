<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\SetlistFm\Tests\Service;

use Core23\SetlistFm\Connection\ConnectionInterface;
use Core23\SetlistFm\Service\CountryService;
use PHPUnit\Framework\TestCase;

class CountryServiceTest extends TestCase
{
    private $connection;

    protected function setUp()
    {
        $this->connection =  $this->prophesize(ConnectionInterface::class);
    }

    public function testItIsInstantiable(): void
    {
        $service = new CountryService($this->connection->reveal());

        $this->assertNotNull($service);
    }

    public function testSearch(): void
    {
        $this->connection->call('search/countries')
            ->willReturn(json_decode(
                <<<'EOD'
                    {
                      "country" : [ {
                        "code" : "US",
                        "name" : "United States"
                      }],
                      "total" : 1,
                      "page" : 1,
                      "itemsPerPage" : 20
                    }
                EOD
                ,
                true
            ))
        ;

        $service = new CountryService($this->connection->reveal());
        $result  = $service->search();

        $this->assertCount(1, $result);
    }
}