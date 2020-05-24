<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="battleScreen">
    <div class="battleMsg">
      <p>An ememy approaches</p>
    </div>
    <div class="attackLog">
      <p id="enemyAttack">The enemy attacks!</p>
      <p id="playerAttack"><?= $data['playerMsg'] ?></p>
    </div>
    <form class="battleOptions" action="<?php echo URLROOT; ?>/battles/turn" method="POST">
      <ul>
        <li>
          <input class="hidden" type="radio" name="playerChoice" id="highAttack" value="highAttack">
          <label for="highAttack" class="button">High Attack</label>
        </li>
        <li>
          <input class="hidden" type="radio" name="playerChoice" id="lowAttack" value="lowAttack">
          <label for="lowAttack" class="button">Low Attack</label>
        </li>
        <li>
          <input class="hidden" type="radio" name="playerChoice" id="dodge" value="dodge">
          <label for="dodge" class="button">Dodge</label>
        </li>
        <li>
          <input class="hidden" type="radio" name="playerChoice" id="defend" value="defend">
          <label for="defend" class="button">Defend</label>
        </li>
        <li>
          <input class="hidden" type="radio" name="playerChoice" id="flee" value="flee">
          <label for="flee" class="button">Flee</label>
        </li>
      </ul>
      <button class="button">Next Turn</button>
    </form>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>