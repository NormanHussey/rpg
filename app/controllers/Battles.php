<?php

  class Battles extends Controller {

    public function __construct() {
      $this->userModel = $this->model('Battle');
    }

    public function index() {
      $data = [
        'playerMsg' => 'Choose your move.'
      ];
      $this->view('battles/index', $data);
    }

    public function turn() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $player = $_SESSION['player'];
        $playerMsg = '';

        switch($_POST['playerChoice']) {

          case 'highAttack':
            $playerMsg = 'The player does a high attack!';
            $player->stamina -= $player->strength;
            break;

          case 'lowAttack':
            $playerMsg = 'The player does a low attack!';
            $player->stamina -= ceil($player->strength / 2);
            break;

          case 'dodge':
            $playerMsg = 'The player dodges!';
            break;

          case 'defend':
            $playerMsg = 'The player defends!';
            break;

          case 'flee':
            $playerMsg = 'The player attempts to flee!';
            break;
     
        }
        
        $data = [
          'playerMsg' => $playerMsg
        ];

        $this->userModel->updatePlayerData();

        $this->view('battles/index', $data);

      } else {

      }
    }
  }