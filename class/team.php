<?php
/**
 * Created by PhpStorm.
 * User: muraty
 * Date: 3/15/14
 * Time: 4:54 PM
 */

namespace champions;


class team {

    public $id;
    public $name;
    public $strength;

    public function __construct($name, $strength = 100, $id = 0)
    {
        $this->name = $name;
        $this->strength = $strength;
        $this->id = $id;
    }

    public function persist()
    {
        if($this->id !== 0)
        {
            $db = \db::getdb();

            $query = $db->prepare('UPDATE team SET name = :name, strength = :strength WHERE id = :id');

            $query->bindParam(':name', $this->name);
            $query->bindParam(':strength', $this->strength);
            $query->bindParam(':id', $this->id);

            $query->execute();

            return true;
        }

        return false;

    }

    public function insert()
    {

        $db = \db::getdb();

        $query = $db->prepare("INSERT INTO team (`name`, `strength`) VALUES (:name,:strength)");


        $query->bindParam(':name', $this->name);
        $query->bindParam(':strength', $this->strength);

        $query->execute();

        return $db->lastInsertId();

    }

    public static function getTeam($name)
    {

        $db = \db::getdb();

        $query = $db->prepare('SELECT * FROM team WHERE name = :name LIMIT 1');

        $query->bindParam(':name', $name);
        $query->execute();

        $team = $query->fetchObject();

        return new team($team->name,$team->strength,$team->id);

    }

    public static function getAllTeams()
    {

        $db = \db::getdb();

        $query = $db->prepare('SELECT * FROM team');

        $query->bindParam(':name', $name);
        $query->execute();

        $team = $query->fetchAll(\PDO::FETCH_OBJ);

        $teams = array();
        foreach($team as $t)
        {
            $teams[] = new team($t->name,$t->strength,$t->id);
        }

        return $teams;

    }

    public static function teamCount()
    {
        $db = \db::getdb();

        $query = $db->query('SELECT Count(*) as sayi FROM team');
        return $query->fetch(\PDO::FETCH_ASSOC)['sayi'];

    }

} 