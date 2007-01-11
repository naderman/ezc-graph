<?php
/**
 * File containing the ezcGraphInvalidDisplayTypeException class
 *
 * @package Graph
 * @version //autogen//
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
/**
 * Exception thrown when an unsupported data type is set for the current chart.
 *
 * @package Graph
 * @version //autogen//
 */
class ezcGraphInvalidDisplayTypeException extends ezcGraphException
{
    public function __construct( $type )
    {
        $chartTypeNames = array(
            ezcGraph::PIE => 'Pie',
            ezcGraph::LINE => 'Line',
            ezcGraph::BAR => 'Bar',
        );

        if ( isset( $chartTypeNames[$type] ) )
        {
            $chartTypeName = $chartTypeNames[$type];
        }
        else
        {
            $chartTypeName = 'Unknown';
        }

        parent::__construct( "Invalid data set display type '$type' ('$chartTypeName') for current chart." );
    }
}

?>
