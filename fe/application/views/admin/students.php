
<main id="main" class="main">
    <div class="pageTitle">
      <h1>Students</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>students">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Students</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <section class="section profile">

     <div class="row">
        

              <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" type="button"><i class="bi bi-plus-circle"> New</i></button>
        </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table datatable table-light" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Alumni Name</th> 
                          
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                <?php
                $i = 1;
                foreach ($Students as $student) { ?>
                  
                  <tr>
                      <td><?= $i; ?></td>
                      <td><?= $student['name'];?></td>
                      
                      <td>
                        <button type="button" id="edit_job_btn" data-id="<?= $student['student_id'];?>" class="btn btn-warning bi bi-pencil"> Modify</button>
                        <!--  <button type="button" class="btn btn-secondary bi bi-folder-symlink"> Archive</button> -->
                      </td>
                  </tr>

               <?php $i++; }
                             
                
                ?>  
                </tbody>
              </table>
            </div>
          </div>
         
        </div>
      </div>
   


    </section>



<!--------------All Modal-------------------->
  

    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Encode New Alumni</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" id="addForm" >
                
                <div class="card-body">

                  <div class="row mb-2">
                    <div class="col">
                      <label for="validationDefault01" class="form-label">Student Name</label>                  
                      <input type="text" class="form-control" name="product_name" id=""  required>  
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col">
                        <label for="" class="form-label">BATCH</label>
                       <select name="batch" id="" class="form-select">
                        <option value="BATCH1">BATCH 1</option>
                       </select>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                        <label for="" class="form-label">PROFESSOR</label>
                        <select name="prof" id="prof" class="form-select">
                          <?php
                            foreach ($Professors as $professor) {
                              ?>
                            <option value="<?= $professor['prof_id']; ?>"><?=$professor['name']; ?></option>

                            <?php
                            }
                          ?>
                        </select>
                    </div>
                  </div>
                 
                  
                </div>                       
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" name="save" id="save" value="Save">
            </div>
        </form>
          </div>
        </div>
      </div><!-- End ADD Modal-->

      <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Product</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" id="updateForm" >

                <!-- hidden product ID --> 
                <input type="hidden" id="product-id" name="product_id">
                <div class="card-body">

                  <div class="row mb-2">
                    <div class="col">
                      <label for="validationDefault01" class="form-label">Product Name</label>                  
                      <input type="text" class="form-control" name="product_name" id="product-name"  required>  
                    </div>
                  </div>
                  
                  
                </div>                       
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" name="save" id="save" value="Save">
            </div>
        </form>
          </div>
        </div>
      </div><!-- End Edit Modal-->

<!---------------end of all Modal---------------------->

  </main> <!------------- end of Main ----->
 <script type="text/javascript" src="<?= base_url();?>assets/admin-assets/ajax/student.js"></script>
  