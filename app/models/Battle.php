<?php

  class Battle {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function updatePlayerData() {
      $player = $_SESSION['player'];
      $this->db->query('UPDATE users SET health = :health, maxHealth = :health, stamina = :stamina, maxStamina = :maxStamina, strength = :strength, agility = :agility, dexterity = :dexterity, luck = :luck, xp = :xp, level = :level WHERE id = :id');
      $this->db->bind(':health', $player->health);
      $this->db->bind(':maxHealth', $player->maxHealth);
      $this->db->bind(':stamina', $player->stamina);
      $this->db->bind(':maxStamina', $player->maxStamina);
      $this->db->bind(':strength', $player->strength);
      $this->db->bind(':agility', $player->agility);
      $this->db->bind(':dexterity', $player->dexterity);
      $this->db->bind(':luck', $player->luck);
      $this->db->bind(':xp', $player->xp);
      $this->db->bind(':level', $player->level);
      $this->db->bind(':id', $_SESSION['user']->id);

      $this->db->execute();
    }

  }