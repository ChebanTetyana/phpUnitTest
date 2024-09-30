<?php

namespace Cheba\PhpUnit\WorldCup;

class Game
{
    public $homeTeam;
    public $awayTeam;
    public $homeScore;
    public $awayScore;

    public function __construct($homeTeam, $awayTeam)
    {
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->homeScore = 0;
        $this->awayScore = 0;
    }
}
