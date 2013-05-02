<?php
$old_password = array(
	'name'	=> 'old_password',
	'id'	=> 'old_password',
	'value' => set_value('old_password'),
	'size' 	=> 30,
);
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size'	=> 30,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'size' 	=> 30,
);
?>
  <form class="form-horizontal" method="post">
    <fieldset>
      <div id="legend" class="">
        <legend class="">Change Password</legend>
      </div>
    <div class="control-group">

          <!-- Text input-->
          <label class="control-label">Current Password</label>
          <div class="controls">
            <?php echo form_password($old_password); ?>
            <p class="help-block"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']])?error_message($errors[$old_password['name']]):''; ?></p>
          </div>
        </div>

    <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="input01">New Password</label>
          <div class="controls">
            <?php echo form_password($new_password); ?>
            <p class="help-block"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?error_message($errors[$new_password['name']]):''; ?></p>
          </div>
        </div>

    <div class="control-group">

          <!-- Text input-->
          <label class="control-label" for="input01">Verify Password</label>
          <div class="controls">
            <?php echo form_password($confirm_new_password); ?>
            <p class="help-block"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?error_message($errors[$confirm_new_password['name']]):''; ?></p>
          </div>
        </div>

    

    <div class="control-group">
          <label class="control-label"></label>

          <!-- Button -->
          <div class="controls">
            <button class="btn btn-primary">Save Changes</button>
          </div>
        </div>

    </fieldset>
  </form>
