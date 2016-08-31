<?php 
include 'phpgraphlib.php';
include 'phpgraphlib_pie.php';
$graph = new PHPGraphLib(600,250);
$data = array("Alex"=>99, "Mary"=>98, "Joan"=>70, "Ed"=>90);
$graph->addData($data);
$graph->setTitle("Test Scores");
$graph->setTextColor("blue");
$graph->createGraph();
?>