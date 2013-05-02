<?php
$username = array(
    'name' => 'username',
    'id' => 'username',
    'value' => set_value('username'),
    'maxlength' => $this->config->item('username_max_length', 'tank_auth'),
    'size' => 30,
    'placeholder' => "username",
    'class' => "input-xlarge",
    'type' => "text",
);
$email = array(
    'name' => 'email',
    'id' => 'email',
    'type' => 'email',
    'value' => set_value('email'),
    'maxlength' => 80,
    'size' => 30,
    'placeholder'=>"email", 
    'class'=>"input-xlarge"    
);
$managing = array(
    'name' => 'managing',
    'id' => 'managing',
    'type' => 'text',
    'value' => set_value('managing'),
    'maxlength' => 10,
    'size' => 30,
    'placeholder'=>"Managing Id"    
);
$password = array(
    'name' => 'password',
    'id' => 'password',
    'value' => set_value('password'),
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'size' => 30,
    'placeholder' => "password",
    'class' => "input-xlarge",
    'type' => "text",
);
?>
<form class="form-horizontal" method="post">
    <fieldset>
        <div id="legend" class="">
            <legend class="">User Creation</legend>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">Username</label>
            <div class="controls">
                <?php echo form_input($username); ?>
                <p class="help-block"> <?php echo form_error($username['name']); ?></p>
            </div>
        </div>

        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">password</label>
            <div class="controls">
                <?php echo form_input($password); ?>
                <p class="help-block">leave blank to auto generate username as password</p>
            </div>
        </div>

        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">email</label>
            <div class="controls">
                <?php echo form_input($email); ?>
                <p class="help-block"><?php echo form_error($email['name']); ?>valid email id</p>
            </div>
        </div>
        <div class="control-group">
            <!-- Text input-->
            <label class="control-label">Managing id</label>
            <div class="controls">
                <?php echo form_input($managing); ?>   
                <p class="help-block"> <?php echo form_error($managing['name']); ?></p>
            </div>
        </div>

        <div class="control-group">
            <!-- Select Basic -->
            <label class="control-label">User Group</label>
            <div class="controls">
                <select class="input-xlarge" name="usergroup" id="usergroup">
                    <?php
                    foreach ($usergroups as $usergroup) {
                        echo "<option value='" . $usergroup->id . "'>" . $usergroup->usergroup . "</option>";
                    }
                    ?>
                </select>
            </div>

        </div>

        <div class="control-group">
            <label class="control-label"></label>
            <!-- Button -->
            <div class="controls">
                <button class="btn btn-primary">Create</button>
            </div>
        </div>

    </fieldset>
</form>
