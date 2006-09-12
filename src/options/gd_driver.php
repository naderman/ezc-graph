<?php
/**
 * File containing the ezcGraphDriverOption class
 *
 * @package Graph
 * @version //autogentag//
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
/**
 * Class containing the basic options for charts
 *
 * @property int $imageFormat
 *           Type of generated image.
 *           Should be one of those: IMG_PNG, IMG_JPEG
 * @property int $detail
 *           Count of degrees to render one polygon for in circular arcs
 * @property int $supersampling
 *           Factor of supersampling used to simulate antialiasing
 * @property string $background
 *           Background image to put the graph on
 * @property string $resampleFunction
 *           Function used to resample / resize images
 * @property bool $forceNativeTTF
 *           Force use of native ttf functions instead of free type 2
 * @property float $imageMapResolution
 *           Degree step used to interpolate round image primitives by 
 *           polygons for image maps
 *
 * @package Graph
 */
class ezcGraphGdDriverOptions extends ezcGraphDriverOptions
{
    /**
     * Constructor
     * 
     * @param array $options Default option array
     * @return void
     * @ignore
     */
    public function __construct( array $options = array() )
    {
        $this->properties['imageFormat'] = IMG_PNG;
        $this->properties['detail'] = 1;
        $this->properties['shadeCircularArc'] = .5;
        $this->properties['supersampling'] = 2;
        $this->properties['background'] = false;
        $this->properties['resampleFunction'] = 'imagecopyresampled';
        $this->properties['forceNativeTTF'] = false;
        $this->properties['imageMapResolution'] = 10;

        parent::__construct( $options );
    }
    
    /**
     * Set an option value
     * 
     * @param string $propertyName 
     * @param mixed $propertyValue 
     * @throws ezcBasePropertyNotFoundException
     *          If a property is not defined in this class
     * @return void
     */
    public function __set( $propertyName, $propertyValue )
    {
        switch ( $propertyName )
        {
            case 'imageFormat':
                if ( imagetypes() & $propertyValue )
                {
                    $this->properties['imageFormat'] = (int) $propertyValue;
                }
                else
                {
                    throw new ezcBaseValueException( $propertyName, $propertyValue, 'Unsupported image type.' );
                }
                break;
            case 'detail':
                $this->properties['detail'] = max( 1, (int) $propertyValue );
                break;
            case 'supersampling':
                $this->properties['supersampling'] = (int) max( 1, $propertyValue );
                break;
            case 'background':
                if ( $propertyValue === false ||
                     ( is_file( $propertyValue ) && is_readable( $propertyValue ) ) )
                {
                    $this->properties['background'] = realpath( $propertyValue );
                }
                else
                {
                    throw new ezcBaseValueException( $propertyName, $propertyValue, 'readable file' );
                }
                break;
            case 'resampleFunction':
                if ( function_exists( $propertyValue ) )
                {
                    $this->properties['resampleFunction'] = $propertyValue;
                }
                else
                {
                    throw new ezcBaseValueException( $propertyName, $propertyValue, 'function' );
                }
                break;
            case 'forceNativeTTF':
                $this->properties['forceNativeTTF'] = (bool) $propertyValue;
                break;
            case 'imageMapResolution':
                $this->properties['imageMapResolution'] = max( 1, (int) $propertyValue );
                break;
            default:
                parent::__set( $propertyName, $propertyValue );
                break;
        }
    }

    protected function checkFont( $font )
    {
        // We expect a valid font file here.
        if ( !is_file( $font ) || !is_readable( $font ) )
        {
            throw new ezcBaseFileNotFoundException( $font );
        }

        // @TODO: Check if font file is a valid TTF file.
        $this->font = realpath( $font );
    }
}

?>
