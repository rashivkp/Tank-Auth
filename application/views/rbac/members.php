<div class='hero-unit'><h3><?= $usergroups[0]->usergroup ?></h3>
    <p><strong><?= $usergroups[0]->description ?></strong></p>
    <div class='btn-group'>
        <a class='btn' href='<?=site_url("usermanagement/edit_usergroup/".$usergroups[0]->id)?>'><i class='icon-pencil'></i> Edit Group</a>
        <a class='btn'><i class='icon-trash'></i> Delete Group</a>
    </div>
</div>
<table class="table">
    <tbody>
        <tr>
            <th>Username</th>
            <th>email</th>            
            <td>&nbsp;</td>
        </tr>
        <?php
        foreach ($users as $user) {
            ?>
            <tr>
                <td><?= $user->username ?></td>
                <td><?= ($user->email) ? $user->email : '' ?></td>            
                <td><a class='btn' href='<?= site_url("usermanagement/reset_password/$user->username") ?>'>
                        <i class='icon-retweet'></i> Reset Password </a>
                    <a class='btn' href='<?= site_url("usermanagement/remove_user/".$usergroups[0]->id."/".$user->id) ?>'>
                        <i class='icon-trash'></i> Delete User </a></td>
            </tr>
            <?php
        }
        ?>                                        
    </tbody>
</table>
