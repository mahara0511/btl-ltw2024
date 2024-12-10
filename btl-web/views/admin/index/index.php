
<?php


include ROOT_PATH. "/views/admin/layouts/sidenav.php";
include ROOT_PATH. "/views/admin/layouts/topheader.php";
include "activitity.php";

?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
         <div class="panel-body">
		<a>
            <?php  //success message
            if(isset($_POST['success'])) {
            $success = $_POST["success"];
            echo "<div class='col-md-12 col-xs-12' id='product_msg'>
          <div class='alert alert-success'>
            <a href='#'' class='close' data-dismiss='alert' aria-label='close'>×</a>
            <b>Product is Added..!</b>
          </div>
        </div>";
            }
            ?></a>
                </div>

          <button type='button' class='btn btn-success editBtn ' data-toggle='modal' data-target='#editUserModal'>
              Edit About Info
          </button>    
      
          <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editAboutModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="editAboutModalLabel">Edit About Info</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form id="editAboutForm" method="post">
                      <input type="hidden" style="color: #000;" name="about_id" id="editAboutId">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Phone Number</label>
                            <input type="text" style="color: #000;" value="1" name="phone" id="editPhone" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Email</label>
                            <input type="text" style="color: #000;" value="1" name="email" id="editEmail" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Location</label>
                            <input type="text" style="color: #000;" value="1" name="location" id="editLocation" class="form-control" required>
                          </div>
                        </div>
                      </div>


                      <button type="submit" style="background-color: #007bff; float: right;" class="btn">Save</button>
                      </form>
                  </div>
                  </div>
              </div>
            </div>
          <div class="col-md-14">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title"> Users List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive ps">
                  <table class="table table-hover tablesorter " id="">
                    <thead class=" text-primary">
                        <tr><th>ID</th><th>FirstName</th><th>LastName</th><th>Email</th><th>Password</th><th>Contact</th><th>Address</th><th>District</th><th>Province</th>
                    </tr></thead>
                    <tbody>
                      <?php 
                        while(list($user_id,$first_name,$last_name,$email,$password,$phone,$address, $district, $province)=mysqli_fetch_array($all_users))
                        {	
                        echo "<tr><td>$user_id</td><td>$first_name</td><td>$last_name</td><td>$email</td><td>$password</td><td>$phone</td><td>$address</td><td>$district</td><td>$province</td>

                        </tr>";
                        }
                        ?>
                    </tbody>
                  </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-md-6">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title"> Categories List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive ps">
                  <table class="table table-hover tablesorter " id="">
                    <thead class=" text-primary">
                        <tr><th>ID</th><th>Categories</th><th>Count</th>
                    </tr></thead>
                    <tbody>
                    <?php foreach ($cate_data as $category): ?>
                        <tr>
                            <td><?php echo $category['cat_id']; ?></td>
                            <td><?php echo $category['cat_title']; ?></td>
                            <td><?php echo $category['count']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                  </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Brands List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive ps">
                  <table class="table table-hover tablesorter " id="">
                    <thead class=" text-primary">
                        <tr><th>ID</th><th>Brands</th><th>Count</th></tr>
                    </thead>
                    <tbody>
                      <?php foreach ($brand_data as $brand):?>
                        <tr>
                          <td><?php echo $brand['brand_id']; ?></td>
                          <td><?php echo $brand['brand_title']; ?></td>
                          <td><?php echo $brand['count']; ?></td>
                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              </div>
            </div>
          </div>
           </div>
           <div class="col-md-5">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Subscribers</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive ps">
                  <table class="table table-hover tablesorter " id="">
                    <thead class=" text-primary">
                        <tr><th>ID</th><th>email</th>
                    </tr></thead>
                    <tbody>

                      <?php 
                        while(list($email_id,$email)=mysqli_fetch_array($subcribers))
                        {	
                        echo "<tr><td>$email_id</td><td>$email</td>

                        </tr>";
                        }
                        ?>
                    </tbody>
                  </table>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              </div>
            </div>
          </div>
           
            
          
        </div>
      </div>


<script>
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
          
          fetch('http://localhost/admin/aboutInfo/get', {
            method: 'GET',
          }) 
          .then(response => response.json())
          .then(data => {
              console.log(data);
              document.getElementById('editLocation').value = data['location'];
              document.getElementById('editEmail').value = data['email'];
              document.getElementById('editPhone').value = data['phone_num'];
          })
        });
    });


    document.getElementById('editAboutForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission
        console.log('submit');
        const location = document.getElementById('editLocation').value.trim();
        const email = document.getElementById('editEmail').value.trim();
        const phone = document.getElementById('editPhone').value.trim();


        let errors = [];

        // Validate required fields
        if (!location) errors.push("Location is required.");
        if (!phone) errors.push("Phone is required.");
        if (!email) errors.push("Email is required.");


        // Validate email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) {
            errors.push("Invalid email format.");
        }

        // If there are validation errors, show them and prevent form submission
        if (errors.length > 0) {
            alert(errors.join("\n"));
            return;
        }

        const formData = new FormData(this);
        // formData.forEach((value, key) => {
        //     console.log(key, value);
        // });
        fetch('http://localhost/admin/aboutInfo/edit', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Updated successfully!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Yes',
                }).then((response) => {
                    if (response.isConfirmed) {
                        location.reload(); // Reload the page to show updated data
                    }
                });
            } else {
                console.log(data.message);
                Swal.fire({
                    title: 'Error',
                    text: data.message,
                    icon: 'error',
                    confirmButtonText: 'Try again',
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'An error occurred while updating about info.',
                icon: 'error',
                confirmButtonText: 'Try again',
            });
        });
    });
  
</script>
      <?php include ROOT_PATH. "/views/admin/layouts/footer.php";?>