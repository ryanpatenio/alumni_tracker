<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Alumni Tracker | Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url() ?>assets/admin-assets/img/favicon.png" rel="icon">
  <link href="<?=base_url() ?>assets/admin-assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=base_url() ?>assets/admin-assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url() ?>assets/admin-assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=base_url() ?>assets/admin-assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=base_url() ?>assets/admin-assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?=base_url() ?>assets/admin-assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?=base_url() ?>assets/admin-assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?=base_url() ?>assets/admin-assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=base_url() ?>assets/admin-assets/css/style.css" rel="stylesheet">

  <script src="<?= base_url();?>assets/admin-assets/vendor/jquery-min.js"></script>
  <script>
		var baseUrl = '<?= base_url(); ?>'
	</script>
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="<?=base_url() ?>" class="logo d-flex align-items-center w-auto">
                  <img src="<?= base_url() ?>assets/admin-assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Login</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <div class="text-center">
										<?= $this->session->flashdata('flash-message'); ?>
									</div>

                  <form class="row g-3" method="POST" id="login" action="">

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>

                        <input type="text" name="email" class="form-control" required value="">

                        <!-- <div class="invalid-feedback"></div> -->
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="" class="form-label">Password</label>

                      <input type="password" name="password" class="form-control" required>
                      <div class="invalid-feedback"></div>
                    
                    </div>

                    <!-- <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div> -->
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <!-- <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="pages-register.html">Create an account</a></p>
                    </div> -->
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="<?=base_url() ?>assets/admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url() ?>assets/admin-assets/vendor/php-email-form/validate.js"></script>
  <script src="<?=base_url() ?>assets/admin-assets/vendor/tinymce/tinymce.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=base_url() ?>assets/admin-assets/js/main.js"></script>

</body>

</html>

<script>
// $(document).ready(function(){

//  $('#login').submit(function(e){
//     e.preventDefault();

//     let fd = $(this).serialize();
//     $url = baseUrl + "AuthController/login";
//     $.ajax({

//         url:$url,
//         method:'POST',
//         data:fd,
//         dataType:'json',

//         success:function(response){
//           console.log(response);
//         },

//         error:function(xhr,status,error){
//           console.log(xhr.responseText);
//         }
//     })

//  })

// });

</script>