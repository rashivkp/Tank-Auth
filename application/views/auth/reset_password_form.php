<?php
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
<?php echo form_open($this->uri->uri_string(),'method="post" class="form-horizontal"'); ?>
<legend>Set New Password</legend>
	<div class="control-group">
		<?php echo form_label(lang('auth_form_new_password'), $new_password['id'], array('class'=>'control-label')); ?></td>
		<div class="controls"><?php echo form_password($new_password); ?>
            <p class="help-block"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?error_message($errors[$new_password['name']]):''; ?></p>
        </div>
    </div>
    <div class="control-group">
		<?php echo form_label(lang('auth_form_new_password_confirm'), $confirm_new_password['id'], array('class'=>'control-label')); ?>
		<div class="controls"><?php echo form_password($confirm_new_password); ?>
            <p class="help-block"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?error_message($errors[$confirm_new_password['name']]):''; ?></p>
        </div>
	</div>
    <div class="control-group">
        <div class="controls">
            <?php echo form_submit('change', lang('auth_form_reset_password_submit'), "class='btn btn-inverse'"); ?>
        </div>
    </div>
<?php echo form_close(); ?>