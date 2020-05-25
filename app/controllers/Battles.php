<?php

  class Battles extends Controller {

    public function __construct() {
      $this->userModel = $this->model('Battle');
    }

    public function index() {
      $enemy = $this->userModel->getEnemy(1);
      $_SESSION['enemy'] = new Enemy($enemy->name, $enemy->health, $enemy->stamina, $enemy->xp, $enemy->strength, $enemy->agility, $enemy->dexterity, $enemy->opener);
      $data = [
        'playerMsg' => 'Choose your move.',
        'enemyMsg' => $enemy->opener
      ];
      $this->view('battles/index', $data);
    }

    public function getPlayerMove($choice) {
      $player = $_SESSION['player'];
      $enemy = $_SESSION['enemy'];

      switch($choice) {
        case 'highAttack':
          return $player->highAttack($enemy);
          break;

        case 'lowAttack':
          return $player->lowAttack();
          break;

        case 'dodge':
          return $player->dodge($enemy);
          break;

        case 'defend':
          return $player->defend();
          break;

        case 'flee':
          return [false, 'You attempt to flee but fail!'];
          break;
      }
    }

    public function processEnemyMove() {

    }

    public function turn() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $player = $_SESSION['player'];
        $enemy = $_SESSION['enemy'];
        $choice = $_POST['playerChoice'];

        $playerMove = $this->getPlayerMove($choice);
        $enemyChoice = $enemy->chooseMove();
        $enemyMove = $enemy->processChoice($enemyChoice);

        $playerMsg = $playerMove[1];
        $enemyMsg = $enemyMove[1];

        // if ($player->agility >= $enemy->agility) { // player goes first
          switch($choice) {
            case 'highAttack':
            case 'lowAttack':
              if ($enemyChoice === 0 || $enemyChoice === 1) { // highAttack or lowAttack
                $enemy->health -= $playerMove[0];
                $player->health -= $enemyMove[0];
              } else if ($enemyChoice === 2) { // dodge
                if (!$enemyMove[0] || $choice = 'lowAttack') {
                  $enemy->health -= $playerMove[0];
                  $enemyMsg = "$enemy->name tried to dodge but failed.";
                }
              } else if ($enemyChoice === 3) { // defend
                $enemy->health -= $playerMove[0] * $enemyMove[0];
              }
            break;

            case 'dodge':
              if ($enemyChoice === 0) { // highAttack
                if (!$playerMove[0]) {
                  $player->health -= $enemyMove[0];
                }
              } else if ($enemyChoice === 1) { // lowAttack
                $player->health -= $enemyMove[0];
                if ($playerMove[0]) {
                  $playerMsg = 'You tried to dodge but failed.';
                }
              } else if ($enemyChoice === 2) { // dodge
                $playerMsg = 'You successfully an attack that never came.';
                $enemyMsg = 'But the enemy dodged as well so you both look like fools.';
              } else if ($enemyChoice === 3) { // defend
                $playerMsg = 'You successfully an attack that never came.';
              }
              break;

            case 'defend':
              if ($enemyChoice === 0 || $enemyChoice === 1) { // highAttack or lowAttack
                $player->health -= $enemyMove[0] * $playerMove[0];
              }
              break;

            case 'flee':
              if (!$playerMove[0]) {
                if ($enemyChoice === 0 || $enemyChoice === 1) { // highAttack or lowAttack
                  $player->health -= $enemyMove[0];
                }
              } else {
                $playerMsg = 'You successfully fled the fight.';
              }
              break;

          }
        // } else { // enemy goes first

        // }

        // $player->health -= $enemyMove[0];
        // $enemy->stamina -= $enemyMove[0];
      
        
        $data = [
          'playerMsg' => $playerMsg,
          'enemyMsg' => $enemyMsg
        ];

        $this->userModel->updatePlayerData();

        $this->view('battles/index', $data);

      } else {
        $this->view('battles/index');
      }
    }
  }