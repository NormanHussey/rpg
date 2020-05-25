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

    public function turn() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $player = $_SESSION['player'];
        $enemy = $_SESSION['enemy'];

        $enemyMove = $enemy->chooseMove();
        $player->health -= $enemyMove[0];
        $enemy->stamina -= $enemyMove[0];
        $enemyMsg = $enemyMove[1];

        $playerMsg = '';

        switch($_POST['playerChoice']) {

          case 'highAttack':
            $move = $player->highAttack();
            $playerMsg = $move[1];
            $enemy->health -= $move[0];
            break;

          case 'lowAttack':
            $move = $player->lowAttack();
            $playerMsg = $move[1];
            $enemy->health -= $move[0];
            break;

          case 'dodge':
            $playerMsg = 'The player dodges!';
            $player->stamina -= 1;
            break;

          case 'defend':
            $playerMsg = 'The player defends!';
            $player->stamina += 2;
            break;

          case 'flee':
            $playerMsg = 'The player attempts to flee!';
            break;
     
        }
        
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