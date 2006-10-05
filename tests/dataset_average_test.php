<?php
/**
 * ezcGraphDataSetAverageTest 
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
class ezcGraphDataSetAverageTest extends ezcTestCase
{
    protected $basePath;

    protected $tempDir;

	public static function suite()
	{
		return new PHPUnit_Framework_TestSuite( "ezcGraphDataSetAverageTest" );
	}

    protected function setUp()
    {
        static $i = 0;
        $this->tempDir = $this->createTempDir( __CLASS__ . sprintf( '_%03d_', ++$i ) ) . '/';
        $this->basePath = dirname( __FILE__ ) . '/data/';
    }

    protected function tearDown()
    {
        if( !$this->hasFailed() )
        {
            $this->removeTempDir();
        }
    }

    /**
     * Compares a generated image with a stored file
     * 
     * @param string $generated Filename of generated image
     * @param string $compare Filename of stored image
     * @return void
     */
    protected function compare( $generated, $compare )
    {
        $this->assertTrue(
            file_exists( $generated ),
            'No image file has been created.'
        );

        $this->assertTrue(
            file_exists( $compare ),
            'Comparision image does not exist.'
        );

        if ( md5_file( $generated ) !== md5_file( $compare ) )
        {
            // Adding a diff makes no sense here, because created XML uses
            // only two lines
            $this->fail( 'Rendered image is not correct.');
        }
    }

    public function testCreateDatasetFromDataset()
    {
        $arrayDataSet = new ezcGraphArrayDataSet( array( -1 => 1, 0 => 0, 1 => 1 ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet );
        $averageDataSet->polynomOrder = 2;

        $polynom = $averageDataSet->getPolynom();

        $this->assertEquals(
            'x^2',
            $polynom->__toString()
        );
    }

    public function testCreateDatasetFromDataset2()
    {
        $arrayDataSet = new ezcGraphArrayDataSet( array( -1 => 2, 1 => 2, 3 => 10 ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet );
        $averageDataSet->polynomOrder = 2;

        $polynom = $averageDataSet->getPolynom();

        $this->assertEquals(
            'x^2 + 1.00',
            $polynom->__toString()
        );
    }

    public function testCreateDatasetFromDataset3()
    {
        date_default_timezone_set( 'MET' );
        $arrayDataSet = new ezcGraphArrayDataSet( array(
            strtotime( 'Jun 2006' ) => 1300000,
            strtotime( 'May 2006' ) => 1200000,
            strtotime( 'Apr 2006' ) => 1100000,
            strtotime( 'Mar 2006' ) => 1100000,
            strtotime( 'Feb 2006' ) => 1000000,
            strtotime( 'Jan 2006' ) =>  965000,
        ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet, 2 );

        $polynom = $averageDataSet->getPolynom();

        $this->assertEquals(
            '0.00 * x^2 + -1.85 * x + 1044430783.35',
            $polynom->__toString()
        );
    }

    public function testCreateDatasetFromDatasetLowOrder()
    {
        $arrayDataSet = new ezcGraphArrayDataSet( array( -1 => 2, 1 => 2, 3 => 10 ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet );
        $averageDataSet->polynomOrder = 1;

        $polynom = $averageDataSet->getPolynom();

        $this->assertEquals(
            '2.00 * x + 2.67',
            $polynom->__toString()
        );
    }

    public function testCreateDatasetFromDatasetHighOrder()
    {
        $arrayDataSet = new ezcGraphArrayDataSet( array( -1 => 2, 1 => 2, 3 => 10 ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet );
        $averageDataSet->polynomOrder = 3;

        $polynom = $averageDataSet->getPolynom();

        $this->assertEquals(
            'x^2 + 1.00',
            $polynom->__toString()
        );
    }

    public function testCreateDatasetFromDatasetHighOrderConstructorParameter()
    {
        $arrayDataSet = new ezcGraphArrayDataSet( array( -1 => 2, 1 => 2, 3 => 10 ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet, 3 );
        $polynom = $averageDataSet->getPolynom();

        $this->assertEquals(
            'x^2 + 1.00',
            $polynom->__toString()
        );
    }

    public function testIterateOverAverageDataset()
    {
        $arrayDataSet = new ezcGraphArrayDataSet( array( -1 => 2, 1 => 2, 3 => 10 ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet );
        $averageDataSet->polynomOrder = 3;

        $this->assertEquals(
            2.,
            $averageDataSet[-1],
            'Polynom should evaluate to 2.',
            .01
        );

        $this->assertEquals(
            2.,
            $averageDataSet[1],
            'Polynom should evaluate to 2.',
            .01
        );

        $this->assertEquals(
            5.,
            $averageDataSet[2],
            'Polynom should evaluate to 5.',
            .01
        );

        $this->assertEquals(
            10.,
            $averageDataSet[3],
            'Polynom should evaluate to 10.',
            .01
        );
    }

    public function testIterateOverAverageDataset2()
    {
        $arrayDataSet = new ezcGraphArrayDataSet( array( -1 => 2, 1 => 2, 3 => 10 ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet );
        $averageDataSet->polynomOrder = 3;

        $stepSize = 4 / 100;
        $start = -1 - $stepSize;

        foreach ( $averageDataSet as $key => $value )
        {
            $this->assertEquals( (string) ( $start += $stepSize ), $key, 'Wrong step.', .01 );
        }
    }

    public function testIterateOverAverageDataset3()
    {
        $arrayDataSet = new ezcGraphArrayDataSet( array( -1 => 2, 1 => 2, 3 => 10 ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet );
        $averageDataSet->polynomOrder = 3;
        $averageDataSet->resolution = 10;

        $stepSize = 4 / 10;
        $start = -1 - $stepSize;

        foreach ( $averageDataSet as $key => $value )
        {
            $this->assertEquals( (string) ( $start += $stepSize ), $key, 'Wrong step.', .01 );
        }
    }

    public function testRenderCompleteLineChart()
    {
        $filename = $this->tempDir . __FUNCTION__ . '.svg';

        $chart = new ezcGraphLineChart();
        $chart->data['Statistical data'] = new ezcGraphArrayDataSet( array(
            '1' => 1,
            '2.5' => -2.3,
            '3.1' => 1.4,
            '4' => 5,
            '5.3' => 1.2,
            '7' => 6.5,
        ) );
        $chart->data['Statistical data']->symbol = ezcGraph::BULLET;

        $chart->data['polynom order 0'] = new ezcGraphDataSetAveragePolynom( $chart->data['Statistical data'], 0 );
        $chart->data['polynom order 1'] = new ezcGraphDataSetAveragePolynom( $chart->data['Statistical data'], 1 );
        $chart->data['polynom order 3'] = new ezcGraphDataSetAveragePolynom( $chart->data['Statistical data'], 3 );
        $chart->data['polynom order 5'] = new ezcGraphDataSetAveragePolynom( $chart->data['Statistical data'], 5 );
        
        $chart->xAxis = new ezcGraphChartElementNumericAxis();

        $chart->render( 500, 200, $filename );

        $this->compare(
            $filename,
            $this->basePath . 'compare/' . __CLASS__ . '_' . __FUNCTION__ . '.svg'
        );
    }

    public function testRenderCompleteLineChart2()
    {
        $filename = $this->tempDir . __FUNCTION__ . '.svg';

        $chart = new ezcGraphLineChart();
        date_default_timezone_set( 'MET' );
        $chart->data['Statistical data'] = new ezcGraphArrayDataSet( array(
            'Jun 2006' => 1300000,
            'May 2006' => 1200000,
            'Apr 2006' => 1100000,
            'Mar 2006' => 1100000,
            'Feb 2006' => 1000000,
            'Jan 2006' =>  965000,
        ) );
        $chart->data['Statistical data']->symbol = ezcGraph::BULLET;

        $chart->data['polynom order 2'] = new ezcGraphDataSetAveragePolynom( $chart->data['Statistical data'], 2 );
        
        $chart->xAxis = new ezcGraphChartElementNumericAxis();

        try
        {
            $chart->render( 500, 200, $filename );
        }
        catch ( ezcGraphDatasetAverageInvalidKeysException $e )
        {
            return true;
        }

        $this->fail( 'Expected ezcGraphDatasetAverageInvalidKeysException.' );
    }

    public function testPAverageDataSetIsset()
    {
        $arrayDataSet = new ezcGraphArrayDataSet( array( -1 => 2, 1 => 2, 3 => 10 ) );

        $averageDataSet = new ezcGraphDataSetAveragePolynom( $arrayDataSet );
        $averageDataSet->polynomOrder = 3;
        $averageDataSet->resolution = 10;

        $this->assertSame( 
            isset( $averageDataSet[0] ),
            true,
            'Polygon not properly initialized.'
        );
    }
}
?>
