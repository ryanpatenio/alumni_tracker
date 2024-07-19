

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
       <strong><span>CHMSU Alumni Tracker</span></strong>. All Rights Reserved <?php $year = (new DateTime)->format("Y"); echo $year; ?>
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
    
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
 
  
  <script src="<?= base_url();?>assets/admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url();?>assets/admin-assets/vendor/chart.js/chart.min.js"></script>
  <script src="<?= base_url();?>assets/admin-assets/vendor/echarts/echarts.min.js"></script>
  <script src="<?= base_url();?>assets/admin-assets/vendor/quill/quill.min.js"></script>
  <script src="<?= base_url();?>assets/admin-assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="<?= base_url();?>assets/admin-assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="<?= base_url();?>assets/admin-assets/vendor/php-email-form/validate.js"></script>
  

</script>

  <!-- Template Main JS File -->
  <script src="<?= base_url();?>assets/admin-assets/js/main.js"></script>

</body>

</html>
  <!---- log out page modal---->
    <div class="modal fade" id="logoutModal_AD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a class="btn btn-primary" href="#" id="logout-admin">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="<?= base_url();?>assets/admin-assets/js/moment.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/swal/sweet.js"></script>
<script type="text/javascript" src="<?= base_url();?>assets/admin-assets/js/msg.js"></script>

<?= (file_exists($js_file) ? '<script type="text/javascript" src="' . base_url($js_file) . '"></script>' : '') ?>
