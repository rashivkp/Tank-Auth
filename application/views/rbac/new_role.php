<?php
$role = array(
    'name' => 'role',
    'id' => 'role',
    'value' => set_value('role'),
    'size' => 30,
    'placeholder' => "Role Name",
    'class' => "input-xlarge",
    'type' => "text",
);
?>
<form class="form-horizontal" method="post">
    <fieldset>
        <div id="legend" class="">
            <legend class="">Create New Role</legend>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">Role</label>
            <div class="controls">
                <?=form_input($role);?>
                <p class="help-block">
                    it's good practice to type lowercase letters for Role name<br />
                    <?php echo form_error($role['name']); ?>
                    <?php echo isset($errors[$role['name']]) ? error_message($errors[$role['name']]) : ''; ?>
                </p>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label"></label>

            <!-- Button -->
            <div class="controls">
                <button class="btn btn-primary">Create Scope</button>
            </div>
        </div>



    </fieldset>
</form>
