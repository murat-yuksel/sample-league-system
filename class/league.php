<?php
/**
 * Created by PhpStorm.
 * User: muraty
 * Date: 3/15/14
 * Time: 6:31 PM
 */

namespace champions;


class league {

    protected $champion;
    protected $league;

    public static function getLeague()
    {
        if(isset($_SESSION['lig'])) return $_SESSION['lig'];
        else
        {
            return $_SESSION['lig'] = new league();
        }
    }

    public function startLeague()
    {
        $db = \db::getdb();

        do
        {
            $db->query('truncate `match`');
        }while(!$this->prepareFixture());
    }

    protected function prepareFixture()
    {
        $teams = team::getAllTeams();
        $teamCount = count($teams);

        $matchs = array();

        // tüm maç olasılıklarını çıkarıyoruz
        for($i=0;$i<$teamCount;$i++)
        {
            for($j=0;$j<$i;$j++)
            {
                if($i == $j) continue;
                $matchs[] = new match($teams[$i],$teams[$j]);
            }
        }

        // maçlar rasgele gelsin diye karıştırıyoruz
        shuffle($matchs);

        // hafta sayısı kadar dönücez (takım sayısının yarısı)
        for($week=1;$week<=$teamCount-1;$week++)
        {
            // her hafta maçlar belirlendikçe takımları buraya ekliyicem
            $weekTeams = array();
            $timeout = 0;

            //maçlara tek tek bakıyoruz tüm takımları kullanana kadar
            while(count($weekTeams) != $teamCount)
            {
                $timeout++;
                foreach($matchs as $key => $thematch)
                {
                    //o hafta takımlar seçiliyse atla
                    if(!isset($weekTeams[$thematch->team1->id]) && !isset($weekTeams[$thematch->team2->id]) )
                    {
                        $weekTeams[$thematch->team1->id] = true;
                        $weekTeams[$thematch->team2->id] = true;
                        $thematch->insertMatch($week);

                        //maçlar listemden o maçı kaldırıyorum ki tekrar seçmeyelim
                        unset($matchs[$key]);
                    }

                    // o hafta için tüm takımlar seçildi mi
                    // if(count($weekTeams) == count($teams)) break;
                }
                if($timeout > 50) break;
            }


            unset($weekTeams);
        }

        // tüm maçları yerleştiremeyip döngüden çıkmak zorunda kalırsa false
        if(count($matchs) > 0) return false;
        else return true;

    }

    public function playWeek($week)
    {
        $matchs = match::getMatchsByWeek($week);

        foreach($matchs as $match)
        {
            $match->calculateScore();
            $match->saveMatch();
        }

    }

    public function playAll()
    {
        $takimSayisi = team::teamCount();
        for($i=1;$i <= $takimSayisi/2;$i++)
        {
            $this->playWeek($i);
        }
    }



} 