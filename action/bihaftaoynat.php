<?php

require('../autoload.php');

$lig = new \champions\league();

$lig->playWeek($_SESSION['hafta']);

$notice = $_SESSION['hafta'].'. hafta maçları oynandı.';
include 'notice.php';

$_SESSION['hafta']++;
