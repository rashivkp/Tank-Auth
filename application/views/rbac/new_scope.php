<?php
$scope = array(
    'name' => 'scope',
    'id' => 'scope',
    'value' => set_value('scope'),
    'size' => 30,
    'placeholder' => "scope name",
    'class' => "input-xlarge",
    'type' => "text",
);
?>
<form class="form-horizontal" method="post">
    <fieldset>
        <div id="legend" class="">
            <legend class="">Create New Scope</legend>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label">Scope</label>
            <div class="controls">
                <?=form_input($scope);?>
                <p class="help-block">
                    it's good practice to type lowercase letters for scope<br />
                    <?php echo form_error($scope['name']); ?>
                    <?php echo isset($errors[$scope['name']]) ? error_message($errors[$scope['name']]) : ''; ?>
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
