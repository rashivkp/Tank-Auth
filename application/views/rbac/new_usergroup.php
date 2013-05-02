<form id="new_usergroup_form" class="form-horizontal" method="post">
    <fieldset>
        <div id="legend" class="">
            <legend class="">Create New Usergroup</legend>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">User group name</label>
            <div class="controls">
                <input placeholder="usergroup name" name="usergroup_name" id="usergroup_name" class="input-xlarge" type="text">
                <p class="help-block">
                    <?php echo form_error('usergroup_name'); ?>
                    <?php echo isset($errors['usergroup_name'])?error_message($errors['usergroup_name']):''; ?>
                </p>
            </div>
            
        </div>
        <div class="control-group">
            <label class="control-label">User Scope</label>
            <div class="controls">
                <select id="user_scope" name="user_scope" class="input-xlarge">
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
                <input type="text" class="numbers" name='priority'>
                <p class="help-block">
                    <?php echo form_error('priority'); ?>
                    <?php echo isset($errors['priority'])?error_message($errors['priority']):''; ?>
                </p>
            </div>
        </div>
         <div class="control-group">
            <label class="control-label">Description</label>
            <div class="controls">
                <input type="text" class="input-xxlarge" name='description'>
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
                        ?>
                        <option value="<?= $taskgroup->id ?>"><?= $taskgroup->item ?></option>
                    <?php } ?>
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
                </select>                
            </div>
            <div style="display: none" id="selected_taskgroups_hidden"></div>
            <p class="help-block">
                    <?php echo isset($errors['selected_taskgroups'])?error_message($errors['selected_taskgroups']):''; ?>
                </p>
            
            <div class="controls"><input type='button' id="remove_group" class="btn btn-warning" value="Remove group"></div>
            
        </div>
         <h4 class="">Assigned roles to task groups</h4>
         <div class="control-group">
            <div class="controls" id="roles_assigned">
                <!--<select class="input-xlarge" multiple="multiple">                    
                </select> -->
            </div>            
        </div>
        
        
          <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <input type="submit" class="btn btn-primary btn-large" id="create_usergroup" value="Create Usergroup">
            </div>
        </div>



    </fieldset>    
</form>