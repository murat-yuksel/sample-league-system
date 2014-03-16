<?php

require('../autoload.php');

$lig = new \champions\league();

$matches = \champions\match::getAllMatchs();

$notice = 'Fikstür aşağıdaki gibidir';

include 'notice.php';

$teams = \champions\team::getAllTeams();
foreach($teams as $team)
{
    $teamList[$team->id] = $team;
}

?>

<table>
    <thead>
        <tr>
            <td>Hafta</td>
            <td>1. Takım</td>
            <td>2. Takım</td>
            <td>Skor</td>
        </tr>
    </thead>
    <?php foreach($matches as $match) : ?>
    <tr>
        <td><?php echo $match->week ?>. Hafta</td>
        <td><?php echo $teamList[$match->team1]->name; ?></td>
        <td><?php echo $teamList[$match->team2]->name; ?></td>
        <td><?php echo $match->score->firstTeam.' - '.$match->score->secondTeam; ?></td>
    </tr>
    <?php endforeach; ?>
</table>