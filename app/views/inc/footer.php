    </div>
  </main>
  <?php if(isset($player)) : ?>
    <footer>
      <div class="wrapper">
        <div class="cell">
          <p><?= $player->name ?></p>
          <p>Health: <?= $player->health . ' / ' . $player->maxHealth ?> </p>
          <p>Stamina: <?= $player->stamina . ' / ' . $player->maxStamina ?> </p>
        </div>
        <div class="cell">
          <p>Level: <?= $player->level ?></p>
          <p>XP: <?= $player->xp ?></p>
        </div>
        <div class="cell">
          <p>Strength: <?= $player->strength ?></p>
          <p>Agility: <?= $player->agility ?></p>
          <p>Dexterity: <?= $player->dexterity ?></p>
          <p>Luck: <?= $player->luck ?></p>
        </div>
      </div>
    </footer>
  <?php endif; ?>

  <script src='https://code.jquery.com/jquery-3.4.0.min.js' integrity='sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=' crossorigin='anonymous'></script>
  <script src="<?php echo URLROOT; ?>/js/main.js"></script>
</body>
</html>