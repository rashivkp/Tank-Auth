<div class='hero-unit'>
    <h2>Configuration file contents</h2>
    <code>
        &dollar;config['rbac_roles'] &equals; array( <br />
        <?php
        foreach ($roles as $role) {
            echo "&nbsp;&nbsp;&nbsp;&nbsp;'" . $role->item . "' &equals;&gt; " . $role->id . ", <br />";
        }
        echo ")&semi;"
        ?>
        <br />&dollar;config['rbac_groups'] &equals; array( <br />
        <?php
        $added=array();
        foreach ($taskgroups as $taskgroup) {
            $added[]=  strtolower($taskgroup->item).".php";
            echo "&nbsp;&nbsp;&nbsp;&nbsp;'" . $taskgroup->item . "' &equals;&gt; " . $taskgroup->id . ", <br />";
        }
        echo ")&semi;";
        ?>
    </code>
</div>
<div class="span10">
    <h3>These controllers are not added to rbac </h3>
    <?php   
      $notadded=@array_diff($file_names, $added);  
    foreach ($notadded as $file) {
        echo $file."<br />";
    } ?>
</div>
