<?php

  class Enemy {
    private $name;
    private $maxHealth;
    private $health;
    private $maxStamina;
    private $stamina;
    private $xp;
    private $strength;
    private $agility;
    private $dexterity;
    private $opener;
  
    public function __construct($name, $health, $stamina, $xp, $strength, $agility, $dexterity, $opener){
      $this->name = $name;
      $this->health = $this->maxHealth = $health;
      $this->stamina = $this->maxStamina = $stamina;
      $this->xp = $xp;
      $this->strength = $strength;
      $this->agility = $agility;
      $this->dexterity = $dexterity;

      $this->opener = $opener;
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
              // Enemy is dead
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

    public function highAttack() {
      $damage = round(randomFloat($this->strength * 0.8, $this->strength * 1.2), 2);
      $msg = $this->name . " unleashes a high attack dealing $damage damage!";
      $this->stamina -= $damage;
      return [$damage, $msg];
    }

    public function lowAttack() {
      $damage = round(randomFloat($this->strength / 2 * 0.8, $this->strength / 2 * 1.2), 2);
      $msg = $this->name . " lunges with a low attack dealing $damage damage!";
      $this->stamina -= $damage;
      return [$damage, $msg];
    }

    public function chooseMove() {
      $move = mt_rand(0, 1);
      switch ($move) {
        case 0: // High attack
          return $this->highAttack();
          break;

        case 1: // Low Attack
          return $this->lowAttack();
          break;

        case 2: // Dodge

          break;

        case 3: // Defend

          break;

      }
    }

  
  }