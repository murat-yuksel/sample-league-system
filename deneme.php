<?php

require('autoload.php');
/*
 *
$takim = new \champions\team('fener',100);
$takim->insert();

var_dump($takim);

$takim = new \champions\team('galata',80);
$takim->insert();

var_dump($takim);

$takim = new \champions\team('beşik',90);
$takim->insert();

var_dump($takim);

$takim = new \champions\team('trabzon',70);
$takim->insert();

var_dump($takim);

$takim = new \champions\team('barcelona',100);
$takim->insert();

var_dump($takim);

$takim = new \champions\team('juventus',80);
$takim->insert();

var_dump($takim);

*/

$m1 = memory_get_usage();

$lig = new \champions\league();

$lig->startLeague();

$lig->playAll();

$puanTablosu = new \champions\table();

var_dump($puanTablosu);

$m2 = memory_get_usage();
