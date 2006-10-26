<?php
/**
 * ezcGraphDriverOptionsTest 
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
class ezcGraphDriverOptionsTest extends ezcImageTestCase
{

	public static function suite()
	{
		return new PHPUnit_Framework_TestSuite( "ezcGraphDriverOptionsTest" );
	}

    public function testDriverOptionsPropertyWidth()
    {
        $options = new ezcGraphSvgDriverOptions();

        $this->assertSame(
            false,
            $options->width,
            'Wrong default value for property width in class ezcGraphSvgDriverOptions'
        );

        $options->width = 100;
        $this->assertSame(
            100,
            $options->width,
            'Setting property value did not work for property width in class ezcGraphSvgDriverOptions'
        );
    }

    public function testDriverOptionsPropertyHeight()
    {
        $options = new ezcGraphSvgDriverOptions();

        $this->assertSame(
            false,
            $options->height,
            'Wrong default value for property height in class ezcGraphSvgDriverOptions'
        );

        $options->height = 100;
        $this->assertSame(
            100,
            $options->height,
            'Setting property value did not work for property height in class ezcGraphSvgDriverOptions'
        );
    }

    public function testDriverOptionsPropertyShadeCircularArc()
    {
        $options = new ezcGraphSvgDriverOptions();

        $this->assertSame(
            .5,
            $options->shadeCircularArc,
            'Wrong default value for property shadeCircularArc in class ezcGraphSvgDriverOptions'
        );

        $options->shadeCircularArc = .2;
        $this->assertSame(
            .2,
            $options->shadeCircularArc,
            'Setting property value did not work for property shadeCircularArc in class ezcGraphSvgDriverOptions'
        );
    }

    public function testDriverOptionsPropertyFont()
    {
        $options = new ezcGraphSvgDriverOptions();

        $this->assertSame(
            'ezcGraphFontOptions',
            get_class( $options->font ),
            'Wrong default value for property font in class ezcGraphSvgDriverOptions'
        );

        $fontOptions = new ezcGraphFontOptions();
        $fontOptions->path = dirname( __FILE__ ) . '/data/font2.ttf';

        $options->font = $fontOptions;
        $this->assertSame(
            $fontOptions,
            $options->font,
            'Setting property value did not work for property font in class ezcGraphSvgDriverOptions'
        );

        try
        {
            $options->font = false;
        }
        catch( ezcBaseValueException $e )
        {
            return true;
        }

        $this->fail( 'Expected ezcBaseValueException.' );
    }
}
?>
