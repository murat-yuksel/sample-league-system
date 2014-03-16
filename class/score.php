<?php
/**
 * Created by PhpStorm.
 * User: muraty
 * Date: 3/15/14
 * Time: 5:33 PM
 */

namespace champions;


class score {

    public $firstTeam;
    public $secondTeam;
    public $winner;

    function __construct($first, $second)
    {
        $this->firstTeam = $first;
        $this->secondTeam = $second;

        if($first > $second)
        {
            $this->winner = 1;
        }
        elseif($second > $first)
        {
            $this->winner = 2;
        }
        else
        {
            $this->winner = 0;
        }
    }


} 