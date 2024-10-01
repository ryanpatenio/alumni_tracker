<html></html><!DOCTYPE html>
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

                   <!-- 404 Error Text -->
                   <div class="text-center">
                        <div class="error mx-auto" data-text="403">403</div>
                        <p class="lead text-gray-800 mb-5">Access Forbidden</p>
                        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
                        <a href="<?= base_url('dashboard'); ?>">&larr; Back to Dashboard</a>
                    </div>

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
