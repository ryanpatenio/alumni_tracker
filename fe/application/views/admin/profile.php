
<!-- <main id="main" class="main" style="filter: blur(4px);"> -->
    <main id="main" class="main">
<?php
      #SET NEED TO SHOW
      #SESSION DATA

      #avatar
    //   $avatar = $this->session->userdata('avatar');
    //   $avatar_path = FCPATH . 'uploads/avatar/' . $avatar;
    //   $default_avatar = base_url('assets/admin-assets/avatar/no_avatar.png');

    //   if (file_exists($avatar_path) && !empty($avatar)) {
    //       $avatar_url = base_url('uploads/avatar/' . $avatar);
    //   } else {
    //       $avatar_url = $default_avatar;
    //   }

    //   #NAME
    //   $name = $this->session->userdata('user_name');

    //   #ROLE
    //   $role = $this->session->userdata('role');
    //   $ROLE = '';
    //   if($role == 'SUPER_ADMIN'){
    //     $ROLE = 'ADMINISTRATOR';
    //   }else{
    //     $ROLE = 'SUB ADMINISTRATOR';
    //   }

      ?>

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?= base_url(); ?>profile">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="" alt="Profile" class="rounded-circle">
              <h2>Ryan Wong</h2>
              <h3>Role</h3>
             
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">Ryan Wong</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">ROLE</div>
                    <div class="col-lg-9 col-md-8">Admin</div>
                  </div>

                 

               
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              


                  <!-- Profile Edit Form -->
                  <form method="POST" id="updateProfileForm" enctype="multipart/form-data">
                   
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="" id="display_avatar" alt="Profile">
                        <div class="pt-2">

                          <input type="file" id="my_avatar" name="my_avatar" accept="image/*" class="form-control" title="Upload new profile image">
                          <!-- <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a> -->
                        </div>
                      </div>
                    </div>

                    
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="name" value="Ryan Wong" required>
                      </div>
                    </div>

                   

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">ROLE</label>
                      <div class="col-md-8 col-lg-9">
                          <input type="text" class="form-control" value="Role" readonly>                       
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>


                  

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->

                  <form method="POST" id="changePasswordForm">
                    <div class="row mb-3">
                      <label for="current_Password" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input  type="password" name="currentPassword" class="form-control" id="currentPassword" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input  type="password" name="newPassword" class="form-control" id="new-password" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input  type="password" name="re_password" class="form-control" id="re-password" required>
                      </div>
                    </div>
                    <span id="error_message"></span>

                    <div class="text-center">
                      <button type="submit" id="change-pass-btn" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  
  <script type="text/javascript" src="<?= base_url();?>assets/admin-assets/ajax/profile.js"></script>
