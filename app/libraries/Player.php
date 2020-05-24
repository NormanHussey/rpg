<?php

class Player {
  private $name;
  private $maxHealth;
  private $health;
  private $maxStamina;
  private $stamina;
  private $xp;
  private $level;
  private $strength;
  private $agility;
  private $dexterity;
  private $luck;

  public function __construct($name, $health, $maxHealth, $stamina, $maxStamina, $xp, $strength, $agility, $dexterity, $luck){
    $this->name = $name;
    $this->health = $health;
    $this->maxHealth = $maxHealth;
    $this->stamina = $stamina;
    $this->maxStamina = $maxStamina;
    $this->xp = $xp;
    $this->checkLevel();
    $this->strength = $strength;
    $this->agility = $agility;
    $this->dexterity = $dexterity;
    $this->luck = $luck;
  }

  private function checkLevel() {
    $constA = 3.0;
    $constB = -20;
    $constC = 1000;
    $this->level = max(floor($constA * log( $this->xp + $constC ) + $constB ), 1 );
  }

  public function __get($property) {
    if(property_exists($this, $property)) {
      return $this->$property;
    }
  }

  public function __set($property, $value) {
    if(property_exists($this, $property)) {
      switch($property) {
        case 'stamina':
          $this->$property = $value;
          break;
      }
    }
  }

  public function takeDamage($damage) {
    $this->health -= $damage;
  }
}