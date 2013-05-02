<?php
$name = array(
    'name' => 'profile_name',
    'id' => 'profile_name',
    'value' => $user->name,
    'maxlength' => $this->config->item('username_max_length', 'tank_auth'),
    'size' => 30,
    'placeholder' => "name",
    'class' => "input-xlarge",
    'type' => "text",
);
$email = array(
    'name' => 'email',
    'id' => 'email',
    'type' => 'email',
    'value' => $user->email,
    'maxlength' => 80,
    'size' => 30,
    'placeholder' => "email",
    'class' => "input-xlarge"
);
$mobile = array(
    'name' => 'mobile',
    'id' => 'mobile',
    'type' => 'text',
    'value' => $user->phone,
    'maxlength' => 80,
    'size' => 30,
    'placeholder' => "Mobile No.",
    'class' => "input-xlarge"
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'value' => set_value('password'),
	'size' 	=> 30,
    'class' => "input-xlarge"
);
?>

<form class="form-horizontal" method="post">
    <fieldset>
        <div id="legend" class="">
            <legend class="">Edit Profile</legend>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">Name</label>
            <div class="controls">
                <?php echo form_input($name); ?>
                <p class="help-block"><?php echo form_error($name['name']); ?></p>
            </div>
        </div>

        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">email</label>
            <div class="controls">
                <?php echo form_input($email); ?>
                <p class="help-block"><?php echo form_error($email['name']); ?></p>
            </div>
        </div>

        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">Mobile No.</label>
            <div class="controls">
                <?php echo form_input($mobile); ?>
                <p class="help-block">Do not provide landphone number<br />
                    <?php echo form_error($mobile['name']); ?></p>
            </div>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">Password</label>
            <div class="controls">
                <?php echo form_password($password); ?>
                <p class="help-block"><?php echo form_error($password['name']); ?></p>
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
