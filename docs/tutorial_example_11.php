<?php

require_once 'tutorial_autoload.php';

$graph = new ezcGraphPieChart();
$graph->palette = new ezcGraphPaletteEzGreen();
$graph->title = 'Access statistics';
$graph->legend = false;

$graph->driver = new ezcGraphGdDriver();
$graph->options->font = 'tutorial_font.ttf';

$graph->driver->options->supersampling = 1;
$graph->driver->options->jpegQuality = 100;
$graph->driver->options->imageFormat = IMG_JPEG;

$graph->data['Access statistics'] = new ezcGraphArrayDataSet( array(
    'Mozilla' => 19113,
    'Explorer' => 10917,
    'Opera' => 1464,
    'Safari' => 652,
    'Konqueror' => 474,
) );

$graph->render( 400, 200, 'tutorial_example_11.jpg' );

?>
