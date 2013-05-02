<?php 
foreach($taskgroups as $taskgroup) {
    echo "
        <div class='hero-unit'><h3>".$taskgroup->item."</h3>
            <ol>";
    foreach($roles as $role){
         $description=$this->m_description->get_description($taskgroup->id,$role->id);
            if(isset($description[0]->description) && trim($description=$description[0]->description) !== '')
            //    $description = $description[0]->description;
            
                echo "<li><h5>".$role->item."</h5>$description</li>";
        }       
    
    
    echo "
            </ol>
            <div class='btn-group'>
                <a class='btn' href=".  site_url('usermanagement/define_roles/'.$taskgroup->id)."><i class='icon-pencil'></i> Define Roles</a>                
            </div>
         </div>";
}
?>
    
    