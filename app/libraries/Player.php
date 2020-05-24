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
        case 'health':
          $this->health = $value;
          if ($this->health > $this->maxHealth) {
            $this->health = $this->maxHealth;
          } else if ($this->health <= 0) {
            $this->health = 0;
            // You're Dead
          }
          break;

        case 'stamina':
          $this->stamina = $value;
          if ($this->stamina > $this->maxStamina) {
            $this->stamina = $this->maxStamina;
          } else if ($this->stamina < 0) {
            $this->stamina = 0;
          }
          break;
      }
    }
  }

  public function takeDamage($damage) {
    $this->health -= $damage;
  }
}