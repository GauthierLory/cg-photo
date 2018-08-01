<?php // content="text/plain; charset=utf-8"
require_once ('../Jpgraph/jpgraph.php');
require_once ('../Jpgraph/jpgraph_pie.php');
require_once ('../Jpgraph/jpgraph_pie3d.php');

// Some data
$data = array(40,60,21,33);

$graph = new PieGraph(350,250);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

$graph->title->Set("Connexion par pays");


$p1 = new PiePlot3D($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetColor('black');
$p1->ExplodeSlice(1);
$graph->Stroke();
?>