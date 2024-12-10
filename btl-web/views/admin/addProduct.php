<?php
include "layouts/sidenav.php";
include "layouts/topheader.php";
?>
    <style>
        .form-control {
            color: #fff;
        }

        .form-control:focus {
            color: #fff
        }

        option {
            background-color: #000;
            padding-left: 10px;
        }
    </style>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
          <div class="row">
          
                
         <div class="col-md-7">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Add Product</h5>
              </div>
              <div class="card-body">
                
                  <div class="row">
                    
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Product Title</label>
                        <input type="text" id="product_name" required name="product_name" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="">
                        <label for="">Add Image</label>
                        <input type="file" name="picture" required class="btn btn-fill btn-success" id="picture" >
                      </div>
                    </div>
                     <div class="col-md-12">
                      <div class="form-group">
                        <label>Description</label>
                        <textarea rows="4" cols="80" id="details" required name="details" class="form-control"></textarea>
                      </div>
                    </div>
                  
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Pricing</label>
                        <input type="text" id="price" name="price" required class="form-control" >
                      </div>
                    </div>
                  </div>
              </div>
              
            </div>
          </div>
          <div class="col-md-5">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Categories</h5>
              </div>
              <div class="card-body">
                
                  <div class="row">
                    
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Product Category</label>
                        <select id="product_type" name="product_type" required class="form-control">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_title']; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="">Product Brand</label>
                        <select id="brand" name="brand" required class="form-control">
                            <option value="">Select Brand</option>
                            <?php foreach ($brands as $brand) { ?>
                                <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_title']; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                     
                  
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Product Sale</label>
                        <input type="text" id="sale" name="sale" required class="form-control" >
                      </div>
                    </div>
                  </div>
                
              </div>
              <div class="card-footer">
                  <button type="submit" id="btn_save" name="btn_save" required class="btn btn-fill btn-primary">Save Product</button>
              </div>
            </div>
          </div>
          
        </div>
         </form>
          
        </div>
        <a href="/admin/handleProduct" id="btn_save" name="btn_save" required class="btn btn-fill btn-primary">Back</a>
                        
      </div>
      <?php
include "layouts/footer.php";
?>