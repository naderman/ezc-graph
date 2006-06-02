<?php
/**
 * ezcGraphLineChartTest 
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
class ezcGraphLineChartTest extends ezcTestCase
{
    
    protected $basePath;

	public static function suite()
	{
		return new ezcTestSuite( "ezcGraphLineChartTest" );
	}

    /**
     * setUp 
     * 
     * @access public
     */
    public function setUp()
    {
        $this->basePath = dirname( __FILE__ ) . '/data/';
    }

    /**
     * tearDown 
     * 
     * @access public
     */
    public function tearDown()
    {
    }

    protected function addSampleData( ezcGraphChart $chart )
    {
        $chart->sampleData = array( 'sample 1' => 234, 'sample 2' => 21, 'sample 3' => 324, 'sample 4' => 120, 'sample 5' => 1);
        $chart->sampleData->color = '#CC0000';
        $chart->sampleData->symbol = ezcGraph::DIAMOND;
        $chart->moreData = array( 'sample 1' => 112, 'sample 2' => 54, 'sample 3' => 12, 'sample 4' => 167, 'sample 5' => 329);
        $chart->moreData->color = '#3465A4';
        $chart->evenMoreData = array( 'sample 1' => 300, 'sample 2' => 30, 'sample 3' => 220, 'sample 4' => 67, 'sample 5' => 450);
        $chart->evenMoreData->color = '#73D216';
        $chart->evenMoreData->symbol = ezcGraph::BULLET;
        $chart->evenMoreData->label = 'Even more data';
    }

    public function testElementGenerationLegend()
    {
        try
        {
            $chart = ezcGraph::create( 'Line' );
            $this->addSampleData( $chart );
            $chart->render( 500, 200 );
        }
        catch ( Exception $e )
        {
            $this->fail( $e->getMessage() );
        }
        
        $legend = $this->getNonPublicProperty( $chart->legend, 'labels' );

        $this->assertEquals(
            3,
            count( $legend ),
            'Count of legends items should be <3>'
        );

        $this->assertEquals(
            'sampleData',
            $legend[0]['label'],
            'Label of first legend item should be <sampleData>.'
        );

        $this->assertEquals(
            'Even more data',
            $legend[2]['label'],
            'Label of first legend item should be <Even more data>.'
        );

        $this->assertEquals(
            ezcGraphColor::fromHex( '#CC0000' ),
            $legend[0]['color'],
            'Color for first label is wrong.'
        );

        $this->assertEquals(
            ezcGraphColor::fromHex( '#3465A4' ),
            $legend[1]['color'],
            'Color for second label is wrong.'
        );
    }

    public function testCompleteRendering()
    {
        try
        {
            $chart = ezcGraph::create( 'Line' );
            $chart->title = 'Test graph';
            $this->addSampleData( $chart );
            $chart->driver = new ezcGraphGdDriver();
            $chart->driver->options->font = $this->basePath . 'font.ttf';
            $chart->render( 500, 200, '/home/kore/test.png' );
        }
        catch ( Exception $e )
        {
            echo $e;
            $this->fail( $e->getMessage() );
        }
    }

    public function testRender()
    {
        throw new PHPUnit2_Framework_IncompleteTestError(
            '@TODO: Implement renderer tests for custom padding size.'
        );
        throw new PHPUnit2_Framework_IncompleteTestError(
            '@TODO: Implement renderer tests checking minum symbol size'
        );
    }
}
?>

