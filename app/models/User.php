<?php

  class User {
    private $db;

    public function __construct() {
      $this->db = new Database;
    }

    public function findUserByEmail($email) {
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);
      $row = $this->db->single();

      if ($this->db->rowCount() > 0) {
        return true;
      } else {
        return false;
      }

    }

    public function register($data) {
      $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)');
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);
      
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function login($email, $password) {
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;

      if (password_verify($password, $hashed_password)) {
        return $row;
      } else {
        return false;
      }
    }

    public function createCharacter($data, $id) {
      $this->db->query('UPDATE users SET name = :name, health = :health, maxHealth = :health, stamina = :stamina, maxStamina = :stamina, strength = :strength, agility = :agility, dexterity = :dexterity WHERE id = :id');
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':health', $data['health']);
      $this->db->bind(':maxHealth', $data['health']);
      $this->db->bind(':stamina', $data['stamina']);
      $this->db->bind(':maxStamina', $data['stamina']);
      $this->db->bind(':strength', $data['strength']);
      $this->db->bind(':agility', $data['agility']);
      $this->db->bind(':dexterity', $data['dexterity']);
      $this->db->bind(':id', $id);
      
      if ($this->db->execute()) {
        $this->updateUserSession();
        return true;
      } else {
        return false;
      }
    }

    public function getUserData($id) {
      $this->db->query('SELECT * FROM users WHERE id = :id');
      $this->db->bind(':id', $id);
      $row = $this->db->single();
      return $row;
    }

    public function updateUserSession() {
      if (isset($_SESSION['user'])) {
        $_SESSION['user'] = $this->getUserData($_SESSION['user']->id);
        $this->createPlayer();
      }
    }

    public function createPlayer() {
      $user = $_SESSION['user'];
      $_SESSION['player'] = new Player($user->name, $user->health, $user->maxHealth, $user->stamina, $user->maxStamina, $user->xp, $user->strength, $user->agility, $user->dexterity, $user->luck);
    }
  }