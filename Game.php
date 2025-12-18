<?php

class Game
{
    private int $pairs;
    public function setPairs(int $pairs): void
    {
        $this->pairs = $pairs;
    }
    public function getForce(): int
    {
        return $this->pairs;
    }
}
