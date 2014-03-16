<?php

require('../autoload.php');

$lig = new \champions\league();

$puanTablosu = new \champions\table();
$teams = $puanTablosu->teams;

$notice = $_SESSION['hafta'].'. Haftada Puan Tablosu';
include 'notice.php';

?>
    <table>
        <thead>
        <tr>
            <td>Takımlar</td>
            <td>P</td>
            <td>O</td>
            <td>G</td>
            <td>B</td>
            <td>M</td>
            <td>Av.</td>
        </tr>
        </thead>
        <?php foreach($teams as $team) : ?>
            <tr>
                <td><?php echo $team['name']; ?></td>
                <td><?php echo $team['point']; ?></td>
                <td><?php echo $team['played']; ?></td>
                <td><?php echo $team['win']; ?></td>
                <td><?php echo $team['draw']; ?></td>
                <td><?php echo $team['loose']; ?></td>
                <td><?php echo $team['average']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>