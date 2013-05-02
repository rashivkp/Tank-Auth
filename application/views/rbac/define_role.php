<form class="form-horizontal" method="post">
    <fieldset>
        <legend class="">Define Roles of <?= $taskgroup[0]->item ?> Taskgroup </legend>
        <?php foreach ($roles as $role) { 
            $description=$this->m_description->get_description($taskgroup[0]->id,$role->id);
            if(isset($description[0]->description))
                $description = $description[0]->description;
            ?>
            <div class="control-group">
                <label class="control-label"><?=$role->item?></label>
                <div class="controls">
                    <input name="<?=$role->item.$role->id?>" id="<?=$role->item.$role->id?>" 
                           class="input-xxlarge" type="text" value="<?=$description?>">
                </div>
            </div>
            <?php
        }
        ?>
        <div class="control-group">
            <div class="controls">
                <input type="submit" name="update_description" id="update_description" class="btn btn-large btn-primary" value="Update Description">
            </div>
        </div>



    </fieldset>
</form>
