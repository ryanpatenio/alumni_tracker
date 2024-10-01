
<main id="main" class="main">
    <div class="pageTitle">
      <h1>Users</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>users">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Users</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <section class="section profile">

     <div class="row">
        

              <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#userModal" type="button"><i class="bi bi-plus-circle"> New</i></button>
        </div>

          <div class="card-body">
            <div class="table-responsive">
              <table class="table datatable table-light" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Name</th> 
                    <th>Status</th>
                          
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
             
            
               

                </tbody>
              </table>
            </div>
          </div>
         
        </div>
      </div>
   


    </section>



<!--------------All Modal-------------------->
  

    <div class="modal fade" id="userModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Encode New User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" id="addForm" >
                
                <div class="card-body">

                  <div class="row mb-2">
                    <div class="col">
                      <label for="validationDefault01" class="form-label">Name</label>                  
                      <input type="text" class="form-control" name="user_name" id=""  required placeholder="Name">  
                    </div>
                    
                  </div>

                  <div class="row mb-2" id="">
                    <div class="col">
                      <label for="" class="form-label" id="for-email">Email</label>
                      <input type="text" class="form-control" id="email" required placeholder="Email">
                    </div>
                      
                  </div>

                  <div class="row mb-2" id="">
                    <div class="col">
                      <label for="" class="form-label" id="for-password">Password</label>
                      <input type="password" class="form-control" id="password" required placeholder="Password">
                    </div>
                      
                  </div>

                  <div class="row mb-2" id="">
                    <div class="col">
                      <label for="" class="form-label" id="for-password">Avatar</label>
                      <input type="file" class="form-control" id="_avatar" required >
                    </div>
                      
                  </div>

                  <div class="row mb-2" id="">
                    <div class="col">
                      <label for="" class="form-label" id="for-admin-type">Type</label>
                      <select name="" id="admin-type" class="form-select">
                        <option value="1">Admin</option>
                        <option value="2">Sub-Admin</option>
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
                        <label for="validationDefault01" class="form-label">Name</label>                  
                        <input type="text" class="form-control" name="user_name" id=""  required placeholder="Name">  
                      </div>
                      
                    </div>

                    <div class="row mb-2" id="">
                      <div class="col">
                        <label for="" class="form-label" id="for-email">Email</label>
                        <input type="text" class="form-control" id="email" required placeholder="Email">
                      </div>
                        
                    </div>

                    <div class="row mb-2" id="">
                      <div class="col">
                        <label for="" class="form-label" id="for-password">Password</label>
                        <input type="password" class="form-control" id="password" required placeholder="Password">
                      </div>
                        
                    </div>

                    <div class="row mb-2" id="">
                      <input type="hidden" id="cur_avatar" name="cur_avatar">
                      <div class="col">
                        <label for="" class="form-label" id="for-password">Avatar</label>
                        <input type="file" class="form-control" id="e_avatar" required >
                      </div>
                        
                    </div>

                    <div class="row mb-2" id="">
                      <div class="col">
                        <label for="" class="form-label" id="for-admin-type">Type</label>
                        <select name="" id="admin-type" class="form-select">
                          <option value="1">Admin</option>
                          <option value="2">Sub-Admin</option>
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
 <script type="text/javascript" src="<?= base_url();?>assets/admin-assets/ajax/Product.js"></script>
  