<?php

require('../autoload.php');

$lig = new \champions\league();

$lig->startLeague();
$_SESSION['hafta'] = 1;

$notice = 'Lig Sıfırdan Başlatılmıştır';

include 'notice.php';