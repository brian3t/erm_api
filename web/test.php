<?php

try valhook dparse

//require_once dirname(__DIR__) . '/vendor/dompdf/dompdf/autoload.inc.php';

require_once realpath('../vendor/autoload.php');

use Dompdf\Dompdf;
use pQuery;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
// Create a HTML object with a basic div container
$div = pQuery::parseStr('<div></div>');

// Add some CSS class to the div
$div->addClass('container');

$td = pQuery::parseStr('<td></td>');
$td->setInnerText('Test2');
$div->append($td->html());

// Insert content into the div
$div->html('Inner html of the element ...');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->loadHtml($div->html());
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();