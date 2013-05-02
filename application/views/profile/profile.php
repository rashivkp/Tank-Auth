<div class="container-fluid profile hero-unit">
    <div class="span2">
        <p><a><img  src="<?= base_url('assets/profile/sample.png') ?>" /></a></p>

    </div>
    <div class="span5">
        <table>
            <tbody>
                <tr>
                    <td colspan="2"><h4><?= ($user->name) ? $user->name : '&lt;Name&gt;' ?></h4></td>
                </tr>
                <tr>
                    <td>Username </td>
                    <td><h4> : <?= $user->username ?></h4></td>
                </tr>
                <tr>
                    <td>Email </td>
                    <td><h4> : <?= ($user->email) ? $user->email : '' ?></h4></td>
                </tr>
                <tr>
                    <td>Phone </td>
                    <td><h4> : <?= ($user->phone) ? $user->phone : '&lt;phone number&gt;' ?> </h4></td>
                </tr>
                <tr>
                    <td>User Role </td>
                    <td rowspan="2"><h4> : <?= $usergroup->usergroup ?>   </h4></td>
                </tr>
            </tbody>
        </table>
        <br />
        <p><a href="<?= site_url('welcome/edit') ?>" class="btn btn-info">Edit</a></p>
    </div>
     <?php if($this->session->userdata('userscope') == 'application'){
     /**
      * Application Status
      */
     if($appdetails[0]['is_confirmed'] == 1){
          $appStatus = 'Application is confirmed';
     }
     if($appdetails[0]['is_principal_verified'] == 1){
           $appStatus = 'principal verified and forwarded to Directorate';
     }
     if($appdetails[0]['is_staff_verified'] == 1){
          if($appdetails[0]['accepted_with_priority'] == 1){
               $accept = 'accepted with priority';
          }else{
               $accept = 'accepted without priority';
          }
           $appStatus = 'Directorate verified and '.$accept;
     }
     if($appdetails[0]['app_rejected'] == 1){
          $appStatus = 'Application Rejected';
     }
     if($appdetails[0]['is_confirmed'] == 0){
          $appStatus = 'Not yet confirmed ';

     }
     ?>
    <div class="span5">
        <p class="text-success"><i class="icon-tags"></i><strong>Application Status : </strong> <?php echo $appStatus;?></p>
        <p class="text-error"><i class="icon-tags"></i><strong>Rank List Status :</strong> <?php echo ($appdetails[0]['staff_rank'] == 0) ? 'Not yet prepared' : 'Rank list published. Your rank :  '.$appdetails[0]['sraff_rank'];?></p>
        <p class="text-info"><i class="icon-tags"></i><strong>Provisional List Status :</strong> <?php echo ($appdetails[0]['is_alloted'] == 0) ? 'Not yet prepared' : 'Llist published';?> </p>
    </div>
     <?php }?>


</div>
