<?php
/**
 * File containing the ezcGraphToolsIncompatibleDriverException class
 *
 * @package Graph
 * @version //autogentag//
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
/**
 * Exception thrown when trying to modify rendered images with incompatible
 * graph tools.
 *
 * @package Graph
 * @version //autogentag//
 */
class ezcGraphToolsIncompatibleDriverException extends ezcGraphException
{
    /**
     * Constructor
     * 
     * @param mixed $driver
     * @param string $accepted
     * @return void
     * @ignore
     */
    public function __construct( $driver, $accepted )
    {
        $driverClass = get_class( $driver );
        parent::__construct( "Incompatible driver used. Driver '{$driverClass}' is not an instance of '{$accepted}'." );
    }
}

?>
