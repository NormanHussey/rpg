<?php

  class Users extends Controller {
    public function __construct() {
      $this->userModel = $this->model('User');
    }

    public function index() {
      $this->register();
    }

    public function register() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // process form

        //Sanitize Post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'email_error' => '',
          'password_error' => '',
          'confirm_password_error' => ''
        ];

        if (empty($data['email'])) {
          $data['email_error'] = 'Please enter an email';
        } else {
          if ($this->userModel->findUserByEmail($data['email'])) {
            $data['email_error'] = 'Email is already registered';
          }
        }

        if (empty($data['password'])) {
          $data['password_error'] = 'Please enter a password';
        } else if (strlen($data['password']) < 6) {
          $data['password_error'] = 'Password must be at least 6 characters';
        }

        if (empty($data['confirm_password'])) {
          $data['confirm_password_error'] = 'Please confirm your password';
        } else if ($data['password'] !== $data['confirm_password']) {
          $data['confirm_password_error'] = 'Passwords do not match';
        }

        $rawPassword = $data['password'];

        // Make sure errors are empty
        if (empty($data['email_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
          
          // Hash password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register user
          if($this->userModel->register($data)) {
            $loggedInUser = $this->userModel->login($data['email'], $rawPassword);
            if ($loggedInUser) {
              $this->createUserSession($loggedInUser);
            } else {
              die('User registered but could not be logged in. Please try again.');  
            }
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('users/register', $data);
        }



      } else {
        // load registration form
        $data = [
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'email_error' => '',
          'password_error' => '',
          'confirm_password_error' => ''
        ];

        $this->view('users/register', $data);
      }
    }

    public function login() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // process form

        //Sanitize Post data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_error' => '',
          'password_error' => ''
        ];

        if (empty($data['email'])) {
          $data['email_error'] = 'Please enter an email';
        }

        if (empty($data['password'])) {
          $data['password_error'] = 'Please enter a password';
        }

        if ($this->userModel->findUserByEmail($data['email'])) {
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);
          if ($loggedInUser) {
            // Create session variables
            $this->createUserSession($loggedInUser);
          } else {
            $data['password_error'] = 'Incorrect Password';
            $this->view('users/login', $data);
          }
        } else {
          $data['email_error'] = 'No user found with that email';
        }

        // Make sure errors are empty
        if (empty($data['email_error']) && empty($data['password_error'])) {
          die('SUCCESS');
        } else {
          // Load view with errors
          $this->view('users/login', $data);
        }

      } else {
        // load login form
        $data = [
          'email' => '',
          'password' => '',
          'email_error' => '',
          'password_error' => ''
        ];

        $this->view('users/login', $data);
      }
    }

    public function createUserSession($user) {
      $_SESSION['user'] = $user;
      if ($user->name !== null) {
        $this->userModel->createPlayer();
        redirect('battle/');
      } else {
        redirect('users/createCharacter');
      }
    }

    public function logout() {
      unset($_SESSION['user']);
      session_destroy();
      redirect('users/login');
    }

    public function createCharacter() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'health' => $_POST['health'],
          'stamina' => $_POST['stamina'],
          'strength' => $_POST['strength'],
          'agility' => $_POST['agility'],
          'dexterity' => $_POST['dexterity'],
        ];

        if($this->userModel->createCharacter($data, $_SESSION['user']->id)) {
          $this->createUserSession($_SESSION['user']);
          redirect('/');
        } else {
          die('Something went wrong');
        }

      } else {

        $data = [
          'name' => '',
          'points' => 5
        ];


        if (isLoggedIn()) {
          $this->view('users/createCharacter', $data);
        } else {
          redirect('users/login');
        }
      }
    }


  }