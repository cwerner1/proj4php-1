<?php
include(__DIR__ . "/../vendor/autoload.php");

use proj4php\Proj4php;
use proj4php\Proj;
use proj4php\Point;

class Proj4phpTest extends PHPUnit_Framework_TestCase
{

    public function testTransform()
    {

        $proj4     = new Proj4php();
        $projL93   = new Proj('EPSG:2154', $proj4);
        $projWGS84 = new Proj('EPSG:4326', $proj4);
        $projLI    = new Proj('EPSG:27571', $proj4);
        $projLSud  = new Proj('EPSG:27563', $proj4);
        $projL72   = new Proj('EPSG:31370', $proj4);
        $proj25833 = new Proj('EPSG:25833', $proj4);
        $proj31468 = new Proj('EPSG:31468', $proj4);
        $proj5514  = new Proj('EPSG:5514', $proj4);

// GPS
// latitude        longitude
// 48,831938       2,355781
// 48°49'54.977''  2°21'20.812''
//
// L93
// 652709.401   6859290.946
//
// LI
// 601413.709   1125717.730
//

        $pointSrc  = new Point('652709.401', '6859290.946', $projL93);
        $pointDest = $proj4->transform($projWGS84, $pointSrc);

        $pointSrc  = $pointDest;
        $pointDest = $proj4->transform($projLSud, $pointSrc);

        $pointSrc  = $pointDest;
        $pointDest = $proj4->transform($projWGS84, $pointSrc);

        $pointSrc  = $pointDest;
        $pointDest = $proj4->transform($projLI, $pointSrc);

        $pointSrc  = $pointDest;
        $pointDest = $proj4->transform($projL93, $pointSrc);


        $pointSrc  = new Point('177329.253543', '58176.702191');
        $pointDest = $proj4->transform($projL72, $projWGS84, $pointSrc);

        $pointSrc  = $pointDest;
        $pointDest = $proj4->transform($projWGS84, $projL72, $pointSrc);


        $pointSrc  = $pointDest;
        $pointDest = $proj4->transform($projL72, $proj25833, $pointSrc);

        $pointSrc  = $pointDest;
        $pointDest = $proj4->transform($proj25833, $projWGS84, $pointSrc);

        $pointSrc  = $pointDest;
        $pointDest = $proj4->transform($projWGS84, $proj31468, $pointSrc);

        $pointSrc  = new Point('-868208.53', '-1095793.57');
        $pointDest = $proj4->transform($proj5514, $projWGS84, $pointSrc);

        $pointSrc  = $pointDest;
        $pointDest = $proj4->transform($projWGS84, $proj5514, $pointSrc);
    }


    public function testProjFour()
    {
        $proj4           = new Proj4php();
        $projL93         = new Proj('EPSG:2154', $proj4);
        $projWGS84       = new Proj('EPSG:4326', $proj4);
        $projLI          = new Proj('EPSG:27571', $proj4);
        $projLSud        = new Proj('EPSG:27563', $proj4);
        $projLSeventyTwo = new Proj('EPSG:31370', $proj4);


        $pointSrc = new Point('652709.401', '6859290.946');
        $this->assertEquals('652709.401 6859290.946', $pointSrc->toShortString());

        $pointDest = $proj4->transform($projL93, $projWGS84, $pointSrc);
        $this->assertEquals(2.3557811127971, $pointDest->x, '', 0.1);
        $this->assertEquals(48.831938054369, $pointDest->y, '', 0.1);

        $pointDest = $proj4->transform($projWGS84, $projLSeventyTwo, $pointSrc);
        $this->assertEquals(2179.4161950587, $pointDest->x, '', 20);
        $this->assertEquals(-51404.55306690, $pointDest->y, '', 20);
        $this->assertEquals(2354.4969810662, $pointDest->x, '', 300);
        $this->assertEquals(-51359.251012595, $pointDest->y, '', 300);


        $pointDest = $proj4->transform($projLSeventyTwo, $projWGS84, $pointSrc);
        $this->assertEquals(2.3557811002407, $pointDest->x, '', 0.1);
        $this->assertEquals(48.831938050542, $pointDest->y, '', 0.1);
        $this->assertEquals(2.3557811127971, $pointDest->x, '', 0.1);
        $this->assertEquals(48.831938054369, $pointDest->y, '', 0.1);

        $pointDest = $proj4->transform($projWGS84, $projLSud, $pointSrc);
        $this->assertEquals(601419.93654252, $pointDest->x, '', 0.1);
        $this->assertEquals(726554.08650133, $pointDest->y, '', 0.1);
        $this->assertEquals(601419.93647681, $pointDest->x, '', 0.1);
        $this->assertEquals(726554.08650133, $pointDest->y, '', 0.1);

        $pointDest = $proj4->transform($projLSud, $projWGS84, $pointSrc);

        $this->assertEquals(2.3557810993491, $pointDest->x, '', 0.1);
        $this->assertEquals(48.831938051718, $pointDest->y, '', 0.1);
        $this->assertEquals(2.3557811002407, $pointDest->x, '', 0.1);
        $this->assertEquals(48.831938050527, $pointDest->y, '', 0.1);

        $pointDest = $proj4->transform($projWGS84, $projLI, $pointSrc);

        $this->assertEquals(601415.06988072, $pointDest->x, '', 0.1);
        $this->assertEquals(1125718.0309796, $pointDest->y, '', 0.1);
        $this->assertEquals(601415.06994621, $pointDest->x, '', 0.1);
        $this->assertEquals(1125718.0308472, $pointDest->y, '', 0.1);

        $pointDest = $proj4->transform($projLI, $projL93, $pointSrc);

        $this->assertEquals(652709.40007563, $pointDest->x, '', 0.1);
        $this->assertEquals(6859290.9456811, $pointDest->y, '', 0.1);
        $this->assertEquals(652709.40001126, $pointDest->x, '', 0.1);
        $this->assertEquals(6859290.9458141, $pointDest->y, '', 0.1);
    }
}
