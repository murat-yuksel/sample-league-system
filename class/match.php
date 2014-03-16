<?php
/**
 * Created by PhpStorm.
 * User: muraty
 * Date: 3/15/14
 * Time: 4:54 PM
 */

namespace champions;


class match {

    public $team1;
    public $team2;
    public $score;
    public $week;

    public function __construct($team1, $team2, $score = null, $week = null)
    {
        $this->team1 = $team1;
        $this->team2 = $team2;

        $this->score = $score;
        $this->week = $week;
    }

    public function calculateScore()
    {
        $t = $this->team1;
        $firstFactor = abs($t->strength * 0.1 - rand(1,5));
        $t = $this->team2;
        $secondFactor = abs($t->strength * 0.1 - rand(1,5));

        $this->score = new score($firstFactor, $secondFactor);

        return $this->score;
    }

    public function insertMatch($week = 0)
    {
        $db = \db::getdb();

        if($week === 0)
        {
            $query = $db->prepare('INSERT INTO `match` (team1,team2) VALUES (:team1,:team2)');
        }
        else
        {
            $query = $db->prepare('INSERT INTO `match` (team1,team2,week) VALUES (:team1,:team2,:week)');
            $query->bindParam(':week', $week);
        }

        $query->bindParam(':team1', $this->team1->id);
        $query->bindParam(':team2', $this->team2->id);

        $query->execute();

        return $db->lastInsertId();
    }

    public function saveMatch()
    {

        $db = \db::getdb();

        if(is_object($this->score))
        {
            $query = $db->prepare('UPDATE `match` SET goal1 = :goal1, goal2 = :goal2 WHERE team1 = :team1 AND team2 = :team2 AND week = :week');

            $query->bindParam(':team1', $this->team1);
            $query->bindParam(':team2', $this->team2);
            $query->bindParam(':goal1', $this->score->firstTeam);
            $query->bindParam(':goal2', $this->score->secondTeam);
            $query->bindParam(':week', $this->week);
            $query->execute();
        }
        else
        {
            return false;
        }

        return $db->lastInsertId();

    }

    public static function getMatchsByWeek($week)
    {

        $db = \db::getdb();

        $query = $db->prepare('SELECT * FROM `match` WHERE week = :week');

        $query->bindParam(':week', $week);
        $query->execute();

        $match = $query->fetchAll(\PDO::FETCH_OBJ);

        $matchs = array();
        foreach($match as $t)
        {
            $matchs[] = new match($t->team1,$t->team2,new score($t->goal1,$t->goal2), $t->week);
        }

        return $matchs;

    }

    public static function getAllMatchs()
    {

        $db = \db::getdb();

        $query = $db->query('SELECT * FROM `match`');
        $match = $query->fetchAll(\PDO::FETCH_OBJ);

        $matchs = array();
        foreach($match as $t)
        {
            $matchs[] = new match($t->team1,$t->team2,new score($t->goal1,$t->goal2), $t->week);
        }

        return $matchs;
    }

}