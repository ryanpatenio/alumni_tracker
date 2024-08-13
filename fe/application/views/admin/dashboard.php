
<main id="main" class="main">
    <div class="pageTitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?=base_url();?>dashboard">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Product</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


    <section class="section profile">

     <div class="row">
        

  <!-- Left side columns -->
  <div class="col-lg-10">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                 <!--  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul> -->
                </div>

                <div class="card-body">
                  <h5 class="card-title">Alumni <span>|</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">

                   
                      <h6 id="income-this-day">
                     
                      1000
                      
                      
               
                        
                      </h6>
                      <!-- <span class="text-success small pt-1 fw-bold">20%</span> <span class="text-muted small pt-2 ps-1">30% from Last Month</span> -->

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="filter">
                
                </div>

                <div class="card-body">
                  <h5 class="card-title">Professors <span>|</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    ₱
                    </div>
                    <div class="ps-3">
                      <h6 id="income-this-month"></h6>
                     
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                 
                </div>

                <div class="card-body">
                  <h5 class="card-title">Courses <span>|</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="customer-count">


                      </h6>
                     
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

           


          <!------------------Sections for admin----------------------->

           

          <div class="col-12">
              <div class="card">

                <div class="filter">
                 
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>| This Year</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>


                </div>

              </div>
            </div><!-- End Reports -->

           
 

          </div>
        </div><!-- End Left side columns -->

      </div>
   


    </section>



<!--------------All Modal-------------------->
  

    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">New Product</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" id="addForm" >
                
                <div class="card-body">

                  <div class="row mb-2">
                    <div class="col">
                      <label for="validationDefault01" class="form-label">Product Name</label>                  
                      <input type="text" class="form-control" name="product_name" id=""  required>  
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
