<?php
/**
 * File containing the abstract ezcGraphChart class
 *
 * @package Graph
 * @version //autogentag//
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
/**
 * Class containing the container for the charts datasets
 *
 * @package Graph
 */

class ezcGraphChartSingleDataContainer extends ezcGraphChartDataContainer 
{
    /**
     * Adds a dataset to the charts data
     * 
     * @param string $name Name of dataset
     * @param mixed $values Values to create dataset with
     * @throws ezcGraphTooManyDataSetExceptions
     *          If too many datasets are created
     * @return ezcGraphDataSet
     */
    protected function addDataSet( $name, ezcGraphDataSet $dataSet )
    {
        if ( count( $this->data ) >= 1 &&
             !isset( $this->data[$name] ) )
        {
            throw new ezcGraphTooManyDataSetsExceptions( $name );
        }
        else
        {
            parent::addDataSet( $name, $dataSet );

            // Colorize each data element
            foreach ( $this->data[$name] as $label => $value )
            {
                $this->data[$name]->color[$label] = $this->chart->palette->dataSetColor;
            }
        }
    }
}
?>