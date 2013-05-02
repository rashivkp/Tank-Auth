<?php
$taskgroup = array(
    'name' => 'taskgroup',
    'id' => 'taskgroup',
    'value' => set_value('taskgroup'),
    'size' => 30,
    'placeholder' => "taskgroup",
    'class' => "input-xlarge",
    'type' => "text",
);
?>
<form class="form-horizontal" method="post">
    <fieldset>
        <div id="legend" class="">
            <legend class="">Create New Taskgroup</legend>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">Task Group</label>
            <div class="controls">
                <?=form_input($taskgroup);?>
                <p class="help-block">Enter the controller name as it is..<br />
                    <?php echo form_error($taskgroup['name']); ?>
                    <?php echo isset($errors[$taskgroup['name']]) ? error_message($errors[$taskgroup['name']]) : ''; ?>
                </p>
            </div>
        </div>


        <div class="control-group">
            <label class="control-label"></label>

            <!-- Button -->
            <div class="controls">
                <button class="btn btn-primary">Create Taskgroup</button>
            </div>
        </div>



    </fieldset>
</form>
