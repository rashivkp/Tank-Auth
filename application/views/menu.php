<div class="navbar-wrapper">
     <!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
     <div class="navbar navbar-inverse navbar-static-top" id="main_navbar">
          <div class="navbar-inner">
               <div class="container">
                    <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
                    <button data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar" type="button">
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                    </button>

                    <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
                    <div class="nav-collapse collapse">
                         <ul class="nav">
                              <li class="active"><a href="<?= site_url ('welcome') ?>">Home</a></li>
                              <!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
                              <?php
                                   if ($this->itschool_rbac->has_permission ('Example', array(), TRUE)) {
									    ?>
                                        <li class="dropdown">
                                             <a data-toggle="dropdown" class="dropdown-toggle" href="#">Example <b class="caret"></b></a>
                                             <ul class="dropdown-menu">
                                                  <?= ($this->itschool_rbac->has_permission ('Example', array ('view'), TRUE)) ? '<li><a href="' . site_url ('example/index') . '">view example</a></li>' : ''; ?>
                                             </ul>
                                        </li>
                                        <?php
                                   }
                              ?>
                              <?php
                                   if ($this->itschool_rbac->has_permission ('Usermanagement', array(), TRUE)) {
									    ?>
                                        <li class="dropdown">
                                             <a data-toggle="dropdown" class="dropdown-toggle" href="#">User Management <b class="caret"></b></a>
                                             <ul class="dropdown-menu">
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/index') . '">User Groups</a></li>' : ''; ?>
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/taskgroups') . '">Task Groups</a></li>' : ''; ?>
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/new_user') . '">New User</a></li>' : ''; ?>
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/create_default_users') . '">Create Defualt Users</a></li>' : ''; ?>
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('edit'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/reset_password') . '">Reset Password</a></li>' : ''; ?>
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/new_usergroup') . '">Create User Group</a></li>' : ''; ?>
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/new_taskgroup') . '">Create TaskGroup</a></li>' : ''; ?>
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/new_role') . '">Create Role</a></li>' : ''; ?>
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/new_scope') . '">Create Scope</a></li>' : ''; ?>
                                                  <?= ($this->itschool_rbac->has_permission ('Usermanagement', array ('admin'), TRUE)) ? '<li><a href="' . site_url ('usermanagement/configuration') . '">Configure rbac</a></li>' : ''; ?>
                                             </ul>
                                        </li>
                                        <?php
                                   }
                              ?>
                              <li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="#">Settings<b class="caret"></b></a>
                                   <ul class="dropdown-menu">
                                        <li><a href="<?= site_url ('welcome/edit') ?>">Edit Profile</a></li>
                                        <li><a href="<?= site_url ('auth/change_password') ?>">Change Password</a></li>
                                        <li><a href="<?= site_url ('auth/logout') ?>">Logout</a></li>
                                   </ul>
                              </li>
                              <li><a href="<?= site_url ('auth/logout') ?>">Logout</a></li>
                         </ul>
                    </div><!--/.nav-collapse -->
               </div><!--container-->
          </div><!-- /.navbar-inner -->
     </div><!-- /.navbar -->
</div>
