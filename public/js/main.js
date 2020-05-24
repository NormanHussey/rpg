$(function() {

  if (window.location.pathname === '/rpg/users/createCharacter') {

    const maxPoints = 5;
    let points = maxPoints;

    const $pointsDisplay = $('#points');
    const $health = $('#health');
    const $healthDisplay = $('#healthDisplay');
    const $stamina = $('#stamina');
    const $staminaDisplay = $('#staminaDisplay');
    const $strength = $('#strength');
    const $strengthDisplay = $('#strengthDisplay');
    const $agility = $('#agility');
    const $agilityDisplay = $('#agilityDisplay');
    const $dexterity = $('#dexterity');
    const $dexterityDisplay = $('#dexterityDisplay');

    updateDisplay();    

    function updateDisplay() {
      $pointsDisplay.text(points);
      $healthDisplay.text($health.val());
      $staminaDisplay.text($stamina.val());
      $strengthDisplay.text($strength.val());
      $agilityDisplay.text($agility.val());
      $dexterityDisplay.text($dexterity.val());
    }

    function pointsDown(attr) {
      if (points < maxPoints) {
        points++;
        attr.val(parseInt(attr.val()) - 1);
        updateDisplay();
      }
    }

    function pointsUp(attr) {
      if (points > 0) {
        points--;
        attr.val(parseInt(attr.val()) + 1);
        updateDisplay();
      }
    }

    $('#healthDown').on('click', function () {
      pointsDown($health);
    });

    $('#healthUp').on('click', function (e) {
      pointsUp($health);
    });

    $('#staminaDown').on('click', function () {
      pointsDown($stamina);
    });

    $('#staminaUp').on('click', function (e) {
      pointsUp($stamina);
    });

    $('#strengthDown').on('click', function () {
      pointsDown($strength);
    });

    $('#strengthUp').on('click', function (e) {
      pointsUp($strength);
    });

    $('#agilityDown').on('click', function () {
      pointsDown($agility);
    });

    $('#agilityUp').on('click', function (e) {
      pointsUp($agility);
    });

    $('#dexterityDown').on('click', function () {
      pointsDown($dexterity);
    });

    $('#dexterityUp').on('click', function (e) {
      pointsUp($dexterity);
    });
    
  }

});