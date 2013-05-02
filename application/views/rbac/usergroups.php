<?php 
foreach($usergroups as $usergroup) {
    $permissions=  json_decode($usergroup->item_ids);
    echo "
        <div class='hero-unit'><h3>".$usergroup->usergroup."</h3>
            <p><strong>$usergroup->description</strong></p>
            <p><strong>Scope: $usergroup->scope</strong></p>
            <p><strong>Priority: $usergroup->priority</strong></p>
            <ol>";
    foreach($permissions as $k => $v){
        echo "
            <li><strong>".$groups_config[$k]."</strong><ul class='inline'>";
        foreach($v as $role_k => $role_v) {
            echo "
            <li>".$roles_config[$role_v]."</li>";
        }
        echo "</ul></li>";
    }
    
    echo "
            </ol>
            <div class='btn-group'>
                <a class='btn' href='".  site_url("usermanagement/members/$usergroup->id")."'><i class='icon-list'></i> View Members</a>
                <a class='btn' href='".  site_url("usermanagement/edit_usergroup/$usergroup->id")."'><i class='icon-pencil'></i> Edit Group</a>
                <a class='btn'><i class='icon-trash'></i> Delete Group</a>
            </div>
         </div>";
}
?>
    
    