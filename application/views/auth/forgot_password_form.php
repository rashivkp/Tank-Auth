<?php
$login = array(
    'name' => 'login',
    'id' => 'login',
    'value' => set_value('login'),
    'maxlength' => 80,
    'size' => 30,
    'class' => 'input-xlarge'
);
if ($this->config->item('use_username', 'tank_auth')) {
    $login_label = lang('auth_form_email_login');
}
else {
    $login_label = lang('auth_form_email');
    $login['type'] = 'email';
}
?>
<?php echo form_open($this->uri->uri_string()); ?>
<fieldset>
    <legend>Forgot Password ? </legend>
    <?php echo form_label($login_label,
            $login['id']); ?>
    <?php echo form_input($login); ?>
    <div style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']]) ? error_message($errors[$login['name']]) : ''; ?></div>
    <?php echo form_submit('reset',
        lang('auth_form_forgot_password_submit'),'class="btn btn-primary btn-large"'); ?>
</fieldset>
<?php echo form_close(); ?>