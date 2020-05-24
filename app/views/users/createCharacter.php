<?php require APPROOT . '/views/inc/header.php'; ?>
  <h2>Create your character</h2>
  <form class="registrationForm" action="<?php echo URLROOT; ?>/users/createCharacter" method="POST">
      <label for="name">Character Name: (at least 4 letters)</label>
      <input type="text" id="name" name="name" minlength="4" class="<?php (!empty($data['name_error'])) ? 'invalid' : ''; ?>" value="<?php echo $data['name'] ?>" required />
      <p>You have <span id="points">5</span> points to allocate</p>
      <div class="stat">
        <p>Max Health: <span id="healthDisplay">100</span></p>
        <input class="hidden" type="number" name="health" id="health" value="100" />
        <button class="button" type="button" id="healthDown">-</button>
        <button class="button" type="button" id="healthUp">+</button>
      </div>
      <div class="stat">
        <p>Max Stamina: <span id="staminaDisplay">100</span></p>
        <input class="hidden" type="number" name="stamina" id="stamina" value="100" />
        <button class="button" type="button" id="staminaDown">-</button>
        <button class="button" type="button" id="staminaUp">+</button>
      </div>
      <div class="stat">
        <p>Strength: <span id="strengthDisplay">1</span></p>
        <input class="hidden" type="number" name="strength" id="strength" value="1" />
        <button class="button" type="button" id="strengthDown">-</button>
        <button class="button" type="button" id="strengthUp">+</button>
      </div>
      <div class="stat">
        <p>Agility: <span id="agilityDisplay">1</span></p>
        <input class="hidden" type="number" name="agility" id="agility" value="1" />
        <button class="button" type="button" id="agilityDown">-</button>
        <button class="button" type="button" id="agilityUp">+</button>
      </div>
      <div class="stat">
        <p>Dexterity: <span id="dexterityDisplay">1</span></p>
        <input class="hidden" type="number" name="dexterity" id="dexterity" value="1" />
        <button class="button" type="button" id="dexterityDown">-</button>
        <button class="button" type="button" id="dexterityUp">+</button>
      </div>
      <button class="button" type="submit">Create</button>
    </form>
<?php require APPROOT . '/views/inc/footer.php'; ?>
