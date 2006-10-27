<?php
/**
 * ezcGraphLabeledAxisTest 
 * 
 * @package Graph
 * @version //autogen//
 * @subpackage Tests
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */

/**
 * Tests for ezcGraph class.
 * 
 * @package ImageAnalysis
 * @subpackage Tests
 */
class ezcGraphLabeledAxisTest extends ezcTestCase
{
	public static function suite()
	{
		return new PHPUnit_Framework_TestSuite( "ezcGraphLabeledAxisTest" );
	}

    public function testFactoryLabeledAxis()
    {
        $chart = new ezcGraphLineChart();

        $this->assertTrue(
            $chart->xAxis instanceof ezcGraphChartElementLabeledAxis
            );
    }

    public function testAutomaticLabelingSingle()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 20, 70, 12, 130 ) );
        $chart->render( 500, 200 );

        $this->assertSame(
            array(
                '2000',
                '2001',
                '2002',
                '2003',
            ),
            $this->getAttribute( $chart->xAxis, 'labels' )
        );
    }

    public function testAutomaticLabelingMultiple()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 1045, 1300, 1012, 1450 ) );
        $chart->data['sample2'] = new ezcGraphArrayDataSet( array( 2002 => 1270, 1170, 1610, 1370 ) );
        $chart->render( 500, 200 );

        $this->assertSame(
            array(
                '2000',
                '2001',
                '2002',
                '2003',
                '2004',
                '2005',
            ),
            $this->getAttribute( $chart->xAxis, 'labels' )
        );
    }

    public function testAutomaticLabelingMultipleMixed()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 1045, 2001 => 1300, 2004 => 1012, 2006 => 1450 ) );
        $chart->data['sample2'] = new ezcGraphArrayDataSet( array( 2001 => 1270, 1170, 1610, 1370, 1559 ) );
        $chart->render( 500, 200 );

        $this->assertSame(
            array(
                '2000',
                '2001',
                '2002',
                '2003',
                '2004',
                '2005',
                '2006',
            ),
            $this->getAttribute( $chart->xAxis, 'labels' )
        );
    }

    public function testPositionLeft()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 1045, 1300, 1012, 1450 ) );
        $chart->xAxis->position = ezcGraph::LEFT;
        $chart->render( 500, 200 );

        $this->assertEquals(
            .0,
            $chart->xAxis->getCoordinate( false ),
            'Wrong initial axis position. ',
            .05
        );

        $this->assertEquals(
            .0,
            $chart->xAxis->getCoordinate( '2000' ),
            'Wrong minimal value. ',
            .05
        );

        $this->assertEquals(
            .33,
            $chart->xAxis->getCoordinate( 2001 ),
            'Wrong mid value. ',
            .05
        );

        $this->assertEquals(
            1.,
            $chart->xAxis->getCoordinate( '2003' ),
            'Wrong maximum value. ',
            .05
        );

        $this->assertEquals(
            .0,
            $chart->xAxis->getCoordinate( '1991' ),
            'Wrong return for unknown value. ',
            .05
        );
    }

    public function testPositionRight()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 1045, 1300, 1012, 1450 ) );
        $chart->xAxis->position = ezcGraph::RIGHT;
        $chart->render( 500, 200 );

        $this->assertEquals(
            1.,
            $chart->xAxis->getCoordinate( false ),
            'Wrong initial axis position. ',
            .05
        );

        $this->assertEquals(
            1.,
            $chart->xAxis->getCoordinate( '2000' ),
            'Wrong minimal value. ',
            .05
        );

        $this->assertEquals(
            .66,
            $chart->xAxis->getCoordinate( 2001 ),
            'Wrong mid value. ',
            .05
        );

        $this->assertEquals(
            .0,
            $chart->xAxis->getCoordinate( '2003' ),
            'Wrong maximum value. ',
            .05
        );

        $this->assertEquals(
            1.,
            $chart->xAxis->getCoordinate( '1991' ),
            'Wrong return for unknown value. ',
            .05
        );
    }

    public function testPositionTop()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 1045, 1300, 1012, 1450 ) );
        $chart->xAxis->position = ezcGraph::TOP;
        $chart->render( 500, 200 );

        $this->assertEquals(
            .0,
            $chart->xAxis->getCoordinate( false ),
            'Wrong initial axis position. ',
            .05
        );

        $this->assertEquals(
            .0,
            $chart->xAxis->getCoordinate( '2000' ),
            'Wrong minimal value. ',
            .05
        );

        $this->assertEquals(
            .33,
            $chart->xAxis->getCoordinate( 2001 ),
            'Wrong mid value. ',
            .05
        );

        $this->assertEquals(
            1.,
            $chart->xAxis->getCoordinate( '2003' ),
            'Wrong maximum value. ',
            .05
        );

        $this->assertEquals(
            .0,
            $chart->xAxis->getCoordinate( '1991' ),
            'Wrong return for unknown value. ',
            .05
        );
    }

    public function testPositionBottom()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 1045, 1300, 1012, 1450 ) );
        $chart->xAxis->position = ezcGraph::BOTTOM;
        $chart->render( 500, 200 );

        $this->assertEquals(
            1.,
            $chart->xAxis->getCoordinate( false ),
            'Wrong initial axis position. ',
            .05
        );

        $this->assertEquals(
            1.,
            $chart->xAxis->getCoordinate( '2000' ),
            'Wrong minimal value. ',
            .05
        );

        $this->assertEquals(
            .66,
            $chart->xAxis->getCoordinate( 2001 ),
            'Wrong mid value. ',
            .05
        );

        $this->assertEquals(
            .0,
            $chart->xAxis->getCoordinate( '2003' ),
            'Wrong maximum value. ',
            .05
        );

        $this->assertEquals(
            1.,
            $chart->xAxis->getCoordinate( '1991' ),
            'Wrong return for unknown value. ',
            .05
        );
    }

    public function testAutomaticLabelingWithLotsOfLabels()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 1045, 1300, 1012, 1450, 341, 421, 452, 1203, 540, 1104, 1503, 1204, 1402, 652, 972, 230, 1502, 1305, 983, 872, 934, 1423 ) );
        $chart->render( 500, 200 );

        $this->assertEquals(
            array(
                2000,
                2003,
                2006,
                2009,
                2012,
                2015,
                2018,
                2021,
            ),
            $this->getAttribute( $chart->xAxis, 'displayedLabels' )
        );
    }

    public function testGetLabel()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 1045, 1300, 1012, 1450 ) );
        $chart->render( 500, 200 );

        $this->assertSame(
            '2001',
            $chart->xAxis->getLabel( 1 ),
            'Wrong label returned for step.'
        );
    }

    public function testGetNonexistantLabel()
    {
        $chart = new ezcGraphLineChart();
        $chart->data['sample'] = new ezcGraphArrayDataSet( array( 2000 => 1045, 1300, 1012, 1450 ) );
        $chart->render( 500, 200 );

        $this->assertSame(
            false,
            $chart->xAxis->getLabel( 5 ),
            'Wrong label returned for nonexisting step.'
        );
    }
}

?>
