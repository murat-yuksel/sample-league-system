<?php
/**
 * Created by PhpStorm.
 * User: muraty
 * Date: 3/15/14
 * Time: 4:54 PM
 */

namespace champions;


class table {

    public $teams = array();

    function __construct()
    {
        $this->recalculateTable();
    }

    public function recalculateTable()
    {

        $teamList = team::getAllTeams();

        foreach ($teamList as $team) {
            $this->teams[$team->id]['name'] = $team->name;
            $this->teams[$team->id]['point'] = 0;
            $this->teams[$team->id]['played'] = 0;
            $this->teams[$team->id]['win'] = 0;
            $this->teams[$team->id]['draw'] = 0;
            $this->teams[$team->id]['loose'] = 0;
            $this->teams[$team->id]['average'] = 0;
        }

        $matches = match::getAllMatchs();

        foreach ($matches as $match) {

            if($match->score->firstTeam == null || $match->score->secondTeam == null) continue;

            $this->teams[$match->team1]['played']++ ;
            $this->teams[$match->team2]['played']++ ;

            if($match->score->winner === 1)
            {
                $this->teams[$match->team1]['win']++ ;
                $this->teams[$match->team2]['loose']++ ;
                $this->teams[$match->team1]['point'] += 3 ;
            }
            else if($match->score->winner === 2)
            {
                $this->teams[$match->team1]['loose']++ ;
                $this->teams[$match->team2]['win']++ ;
                $this->teams[$match->team2]['point'] += 3 ;
            }
            else
            {
                $this->teams[$match->team1]['draw']++ ;
                $this->teams[$match->team2]['draw']++ ;
                $this->teams[$match->team1]['point']++ ;
                $this->teams[$match->team2]['point']++ ;
            }

            $average = $match->score->firstTeam - $match->score->secondTeam;
            $this->teams[$match->team1]['average'] += $average;
            $this->teams[$match->team2]['average'] -= $average;

        }

    }

    public function getTable()
    {
        return $this->teams;
    }
}