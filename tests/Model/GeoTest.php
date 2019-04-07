<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\SetlistFm\Tests\Model;

use Core23\SetlistFm\Model\Geo;
use PHPUnit\Framework\TestCase;

class GeoTest extends TestCase
{
    public function testFromApi(): void
    {
        $apiData = json_decode(
            <<<'EOD'
                    {
                        "long" : -118.3267434,
                        "lat" : 34.0983425
                    }
            EOD
        ,
            true
        );

        $geo = Geo::fromApi($apiData);
        $this->assertSame(34.0983425, $geo->getLatitude());
        $this->assertSame(-118.3267434, $geo->getLongitude());
    }
}