<?php
$login = array(
    'name' => 'login',
    'id' => 'login',
    'value' => set_value('login'),
    'maxlength' => 80,
    'size' => 20,
    'style'=> 'width:168px;',
    'autofocus' => 'autofocus',
    'placeholder' => 'Username',
    'required' => 'required',
);
if ($login_by_username AND $login_by_email) {
    $login_label = lang('auth_form_email_login');
} else if ($login_by_username) {
    $login_label = lang('auth_form_login');
} else {
    $login_label = lang('auth_form_email');
    $login['type'] = 'email';
}
$password = array(
    'name' => 'password',
    'id' => 'password',
    'size' => 20,
    'style'=> 'width:168px;',
    'placeholder' => 'Password',
    'required' => 'required',
);
$remember = array(
    'name' => 'remember',
    'id' => 'remember',
    'value' => 1,
    'checked' => set_value('remember'),    
);
$captcha = array(
    'name' => 'captcha',
    'id' => 'captcha',
    'maxlength' => 8,
);
?>
<?php echo  form_open($this->uri->uri_string()); ?>

<fieldset>
	<legend>Login</legend>
    <?php echo form_label($login_label, $login['id']); ?>
    <?php echo form_input($login); ?>
    <?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']]) ? error_message($errors[$login['name']]) : ''; ?>


    <?php echo form_label(lang('auth_form_password'), $password['id']); ?>
    <?php echo form_password($password); ?>
    <?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']]) ? error_message($errors[$password['name']]) : ''; ?>


    <?php
    if ($show_captcha) {
        if ($use_recaptcha) {
            ?>

            <a href="javascript:Recaptcha.reload()"><?php echo lang('auth_captcha_reload') ?></a>		

            <input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
            <?php echo form_error('recaptcha_response_field'); ?>
            <?php echo $recaptcha_html; ?>

    <?php } else { ?>


            <p><?php echo lang('auth_captcha_enter') ?></p>
        <?php echo $captcha_html; ?>



            <?php echo form_label(lang('auth_form_confirmation_code'), $captcha['id']); ?>
            <?php echo form_input($captcha); ?>
            <?php echo form_error($captcha['name']); ?>

        <?php
        }
    }
    ?>
    <label class="checkbox">
<?php echo form_checkbox($remember); ?>
    <?= lang('auth_form_remember') ?>
    </label>

<?php echo "<p>".anchor('/auth/forgot_password/', lang('auth_page_forgot_password'))."</p>"; ?>
    <?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', lang('auth_page_register')); ?>

    <?php echo form_submit('submit', lang('auth_form_login_submit'), 'class="btn btn-inverse btn-large"'); ?>
</fieldset>
<?php echo form_close(); ?>
