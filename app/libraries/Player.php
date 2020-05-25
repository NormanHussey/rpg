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
          $this->health = round($value, 2);
          if ($this->health > $this->maxHealth) {
            $this->health = $this->maxHealth;
          } else if ($this->health <= 0) {
            $this->health = 0;
            // You're Dead
          }
          break;

        case 'stamina':
          $this->stamina = round($value, 2);
          if ($this->stamina > $this->maxStamina) {
            $this->stamina = $this->maxStamina;
          } else if ($this->stamina < 0) {
            $this->stamina = 0;
          }
          break;
      }
    }
  }

  public function highAttack($enemy) {
    $missChance = 1 + floor($enemy->agility / $this->agility);
    if ($this->luck >= mt_rand(0, 500)) {
      $missChance -= $this->luck;
    } else if ($this->luck >= mt_rand(0, 100)) {
      $missChance -= 1;
    }
    if ($missChance < mt_rand(1, (6 * ($this->agility + $this->dexterity)))) {
      $damage = round(randomFloat($this->strength * 0.8, $this->strength * 1.2), 2);
      $msg = "You unleash a high attack dealing $damage damage!";
      $this->stamina -= $damage;
    } else {
      $damage = 0;
      $msg = 'Tough luck, your high attack missed.';
      $this->stamina -= $this->strength;
    }
    return [$damage, $msg];
  }

  public function lowAttack() {
    $damage = round(randomFloat($this->strength / 2 * 0.8, $this->strength / 2 * 1.2), 2);
    $msg = " You lunge with a low attack dealing $damage damage!";
    $this->stamina -= $damage;
    return [$damage, $msg];
  }

  public function dodge($enemy) {
    $dodgeChance = 1 + floor($this->agility / $enemy->agility);
    if ($this->luck >= mt_rand(0, 500)) {
      $dodgeChance += $luck;
    } else if ($this->luck >= mt_rand(0, 100)) {
      $dodgeChance += 1;
    }
    if ($dodgeChance >= mt_rand(1, ($enemy->agility))) {
      return [true, 'You successfully dodged the enemy!'];
    } else {
      return [false, 'You failed to dodge the enemy.'];
    }
  }

  public function defend() {
    $defendPower = round(0.24 + ($this->dexterity / 100), 2);
    if ($defendPower > 1) {
      $defendPower = 1;
    }
    $defPercent = round($defendPower * 100, 2);
    $stamPercent = round($this->stamina * 0.05, 2);
    $this->stamina += $stamPercent;
    return [$defendPower, "You blocked $defPercent% of the attack and recovered $stamPercent stamina."];
  }

  public function flee() {
    return [false, 'You failed to flee.'];
  }

}