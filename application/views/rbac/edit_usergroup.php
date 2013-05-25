<form id="new_usergroup_form" class="form-horizontal" method="post">
    <fieldset>
        <div id="legend" class="">
            <legend class="">Edit <?= $usergroups[0]->usergroup ?> Usergroup </legend>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label">User group name</label>
            <div class="controls">
                <input placeholder="usergroup name" name="usergroup_name" id="usergroup_name" class="input-xlarge" type="text"
                       value="<?= $usergroups[0]->usergroup ?>">
                <p class="help-block">
                    <?php echo form_error('usergroup_name'); ?>
                    <?php echo isset($errors['usergroup_name']) ? error_message($errors['usergroup_name']) : ''; ?>
                </p>
            </div>

        </div>
        <div class="control-group">
            <label class="control-label">User Scope</label>
            <div class="controls">
                <select id="user_scope" name="user_scope" class="input-xlarge">
                    <option value="<?= $usergroups[0]->scope_id ?>"><?= $usergroups[0]->scope ?></option>
                    <?php
                    foreach ($scopes as $scope) {
                        ?>
                        <option value="<?= $scope->id ?>"><?= $scope->scope ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Priority</label>
            <div class="controls">
                <input value="<?= $usergroups[0]->priority ?>" type="text" class="numbersOnly" name='priority'>
                <p class="help-block">
                    <?php echo form_error('priority'); ?>
                    <?php echo isset($errors['priority'])?error_message($errors['priority']):''; ?>
                </p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
                <input type="text" class="input-xxlarge" name='description' value="<?= $usergroups[0]->description ?>">
            </div>
        </div>
        <h4 class="">Define Permissions</h4>

        <div class="control-group">
            <!-- Select Multiple -->
            <label class="control-label">Task Group</label>
            <div class="controls">
                <select id="taskgroups" class="input-xlarge" multiple="multiple">
                    <?php
                    foreach ($taskgroups as $taskgroup) {
                         $id=$taskgroup->id;
                        if( ! is_array(@$permissions->$id))
                        echo "<option value=$taskgroup->id>$taskgroup->item</option>";
                     
                    }
                    ?>
                </select>
            </div>
            <div class="controls"><input type='button' id="add_group" class="btn btn-info" value='add it'></div>

        </div>

        <div class="control-group">

            <!-- Select Basic -->
            <label class="control-label">Define Task Group Roles</label>
            <div class="controls">
                <select id="roles" class="input-xlarge" multiple="multiple">
                    <?php
                    foreach ($roles as $role) {
                        ?>
                        <option value="<?= $role->id ?>"><?= $role->item ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="controls"><input type='button'  id="add_role" class="btn btn-info" value="Add role to selected task group"></div>

        </div>

        <h4 class="">Selected task groups</h4>

        <div class="control-group">

            <!-- Select Multiple -->
            <div class="controls">
                <select id="selected_taskgroups" name="selected_taskgroups[]" multiple="multiple" class="input-xlarge">                    
                    <?php
                    foreach ($permissions as $k => $v) {
                        echo "<option value='$k'>$groups_config[$k]</option>";
                    }
                    ?>
                </select>                
            </div>
            <div style="display: none" id="selected_taskgroups_hidden">
                <?php
                foreach ($permissions as $k => $v) {
                    echo "<input id='selected_tasgroups_h_$k' type='hidden' value='$k' name='selected_tasgroups_h[]'>";
                }
                ?>
            </div>
            <p class="help-block">
                <?php echo isset($errors['selected_taskgroups']) ? error_message($errors['selected_taskgroups']) : ''; ?>
            </p>

            <div class="controls"><input type='button' id="remove_group" class="btn btn-warning" value="Remove group"></div>

        </div>
        <h4 class="">Assigned roles to task groups</h4>
        <div class="control-group">
            <div class="controls" id="roles_assigned">

                <?php
                foreach ($permissions as $k => $v) {
                    echo "<div id='roles_remove_wraper_$k'>            
                    <label class='control-label'><strong>$groups_config[$k]</strong></label>            
                    <select id='role_$k' name='role_" . $k . "[]' multiple='multiple' class='input-xlarge'>";
                    foreach ($v as $k1 => $v1) {
                        echo "<option value='$v1'>$roles_config[$v1]</option>";
                    }

                    echo "</select>             
                    <div id='hidden_roles_$k' style='display:none;'>";
                    foreach ($v as $k1 => $v1) {
                        echo "<input type = 'hidden' name = 'srole_".$k."[]' value = '$v1' id = 'srole_h_$v1'>";
                    }
                    echo "</div>            
                    <div class='controls'>                
                        <input type='button' value='Remove role' id=roles_remove_$k' class='remove_role btn btn-warning' href='#'>
                    </div>
                </div>";
                }
                ?>

                                <!--<select class="input-xlarge" multiple="multiple">                    
                                </select> -->
            </div>            
        </div>


        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <input type="submit" class="btn btn-primary btn-large" id="create_usergroup" value="Save Changes">
            </div>
        </div>



    </fieldset>    
</form>
