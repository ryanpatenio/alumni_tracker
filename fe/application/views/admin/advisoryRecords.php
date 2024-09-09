
<main id="main" class="main">
    <div class="pageTitle">
      <h1>Advisory Records</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>adv-records">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Advisory Records</li>
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
                    <th>Batch Name</th>
                    <th>Professor Name</th> 
                    <th>SY</th>
                    <th>Course</th>
                    <th>Section</th>       
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
             
               
                  <?php
                  $i = 1;
                 foreach ($records as $record) { ?>
                <tr>
                  <td><?=$i; ?></td>
                  <td><?=$record['batch_name']; ?></td>
                  <td><?=$record['prof_name']; ?></td>
                  <td><?=$record['sy']; ?></td>
                  <td><?=$record['course']; ?></td>
                  <td><?=$record['section'];?></td>
                  <td>
                    <button type="button" id="edit_btn" data-id="<?= $record['advisor_id'];?>" class="btn btn-warning bi bi-pencil"> Modify</button>
                    <button type="button" id="delete_btn" data-id="<?= $record['advisor_id'];?>" class="btn btn-danger bi bi-trash"> Delete</button>
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
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Encode New Records</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" id="addForm" >
                
                <div class="card-body">

                  <div class="row mb-2">
                    <div class="col">
                      <label for="validationDefault01" class="form-label">Professor Name</label>                  
                      <select name="prof_name" id="" class="form-select">
                        <?php
                        foreach ($professors as $prof) { ?>

                         <option value="<?=$prof['prof_id'];?>"><?=$prof['name']; ?></option>

                      <?php  }
                        
                        ?>
                        
                      </select>  
                    </div>
                    <div class="col">
                        <label for="" class="form-label">SY</label>
                        <select name="sy" id="sy" class="form-select">
                          <?php
                          foreach ($schoolyear as $sy) { ?>
                           
                           <option value="<?=$sy['sy_id'];?>"><?=$sy['sy_name']; ?></option>

                         <?php }
                          
                          ?>
                           
                        </select>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col">
                        <label for="" class="form-label">Course</label>
                       <select name="course" id="" class="form-select">
                       <?php
                          foreach ($courses as $course) { ?>
                           
                           <option value="<?=$course['course_id'];?>"><?=$course['course_name']; ?></option>

                         <?php }
                          
                          ?>
                       </select>
                    </div>

                    <div class="col">
                      <label for="" class="form-label">Batch Name</label>
                      <select name="batch_name" id="" class="form-select">
                      <?php
                          foreach ($batches as $batch) { ?>
                           
                           <option value="<?=$batch['batch_id'];?>"><?=$batch['batch_name']; ?></option>

                         <?php }
                          
                          ?>
                       
                      </select>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                        <label for="" class="form-label">Section</label>
                        <select name="section" id="section" class="form-select">
                        <?php
                          foreach ($sections as $section) { ?>
                           
                           <option value="<?=$section['sect_id'];?>"><?=$section['number']; ?></option>

                         <?php }
                          
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
                <input type="hidden" id="advisory-id" name="id">
                <div class="card-body">

                  
                <div class="row mb-2">
                    <div class="col">
                      <label for="validationDefault01" class="form-label">Professor Name</label>                  
                      <select name="prof_name" id="" class="form-select">
                        <option value="" id="prof-id"></option>
                        <?php
                        foreach ($professors as $prof) { ?>

                         <option value="<?=$prof['prof_id'];?>"><?=$prof['name']; ?></option>

                      <?php  }
                        
                        ?>
                        
                      </select>  
                    </div>
                    <div class="col">
                        <label for="" class="form-label">SY</label>
                        <select name="sy" id="sy" class="form-select">
                          <option value="" id="sy-id"></option>
                          <?php
                          foreach ($schoolyear as $sy) { ?>
                           
                           <option value="<?=$sy['sy_id'];?>"><?=$sy['sy_name']; ?></option>

                         <?php }
                          
                          ?>
                           
                        </select>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col">
                        <label for="" class="form-label">Course</label>
                       <select name="course" id="" class="form-select">
                        <option value="" id="course-id"></option>
                       <?php
                          foreach ($courses as $course) { ?>
                           
                           <option value="<?=$course['course_id'];?>"><?=$course['course_name']; ?></option>

                         <?php }
                          
                          ?>
                       </select>
                    </div>

                    <div class="col">
                      <label for="" class="form-label">Batch Name</label>
                      <select name="batch_name" id="" class="form-select">
                        <option value="" id="batch-id"></option>
                      <?php
                          foreach ($batches as $batch) { ?>
                           
                           <option value="<?=$batch['batch_id'];?>"><?=$batch['batch_name']; ?></option>

                         <?php }
                          
                          ?>
                       
                      </select>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col">
                        <label for="" class="form-label">Section</label>
                        <select name="section" id="section" class="form-select">
                          <option value="" id="section-id"></option>
                        <?php
                          foreach ($sections as $section) { ?>
                           
                           <option value="<?=$section['sect_id'];?>"><?=$section['number']; ?></option>

                         <?php }
                          
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
      </div><!-- End Edit Modal-->

<!---------------end of all Modal---------------------->

  </main> <!------------- end of Main ----->
 <script type="text/javascript" src="<?= base_url();?>assets/admin-assets/ajax/advisory-records.js"></script>
  