<?php
include "layouts/sidenav.php";
include "layouts/topheader.php";
if(isset($_POST['btn_save']))
{
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$email=$_POST['email'];
$user_password=$_POST['password'];
$mobile=$_POST['phone'];
$address1=$_POST['city'];
$address2=$_POST['country'];

mysqli_query($con,"insert into user_info(first_name, last_name,email,password,mobile,address1,address2) values ('$first_name','$last_name','$email','$user_password','$mobile','$address1','$address2')") 
			or die ("Query 1 is inncorrect........"); 
mysqli_close($con);
}


?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
            
            <div class="col-md-14">
            <div class="card">
                <div class="card-header card-header-primary">
                <h4 class="card-title">Users List
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addUserModal">
                    Add User
                    </button>
                    <button type="button" class="btn btn-danger float-right mr-2" id="deleteSelectedBtn">
                    Delete Selected
                    </button>
                </h4>
                </div>
                <div class="card-body">
                <div class="table-responsive ps">
                    <table class="table table-hover tablesorter">
                    <thead class="text-primary">
                        <tr>
                        <th><input type="checkbox" id="selectAllCheckbox"></th>
                        <th>ID</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while(list($user_id,$first_name,$last_name,$email,$password,$phone,$address1,$address2)=mysqli_fetch_array($all_users)) { 
                            echo "
                            <tr>
                            <td><input type='checkbox' class='rowCheckbox' value='$user_id'></td>
                            <td>$user_id</td>
                            <td>$first_name</td>
                            <td>$last_name</td>
                            <td>$email</td>
                            <td>$password</td>
                            <td>$phone</td>
                            <td>$address1</td>
                            <td>$address2</td>
                            <td>
                                <button type='button' style='background-color: #007bff' class='btn btn-sm editBtn' data-id='$user_id' data-toggle='modal' data-target='#editUserModal'>Edit</button>
                            </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
          
            </div>

            <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" method="post">
                    <input type="hidden" name="user_id" id="editUserId">
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">First Name</label>
                          <input type="text" id="editFirstName" name="first_name" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" name="last_name" id="editLastName"  class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" name="email" id="editEmail" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">phone number</label>
                          <input type="text" id="editPhone" name="phone" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">City</label>
                          <input type="text" name="city" id="editCity"  class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" name="country" id="editAddress" class="form-control" required>
                        </div>
                      </div>
                      
                    </div>

                    <button type="submit" style="background-color: #007bff; float: right;" class="btn">Save</button>
                    </form>
                </div>
                </div>
            </div>
            </div>

          <div class="col-md-12">
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog-centered modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="addUserForm" action="" method="post" name="form" enctype="multipart/form-data">
                      <div class="row">
                        
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Last Name</label>
                            <input type="text" name="last_name" id="last_name"  class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">phone number</label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">City</label>
                            <input type="text" name="city" id="city"  class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Address</label>
                            <input type="text" name="country" id="country" class="form-control" required>
                          </div>
                        </div>
                        
                      </div>
                      
                      <button type="submit" name="btn_save" id="btn_save" class="btn btn-success pull-right">Add</button>
                    
                    </form>
                    </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>

<script>

    // Add User

    document.getElementById('addUserForm').addEventListener('submit', function (e) {
      const firstName = document.getElementById('first_name').value.trim();
      const lastName = document.getElementById('last_name').value.trim();
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value.trim();
      const phone = document.getElementById('phone').value.trim();
      const city = document.getElementById('city').value.trim();
      const country = document.getElementById('country').value.trim();

      let errors = [];

      // Kiểm tra các trường không được để trống
      if (!firstName) errors.push("First Name is required.");
      if (!lastName) errors.push("Last Name is required.");
      if (!email) errors.push("Email is required.");
      if (!password) errors.push("Password is required.");
      if (!phone) errors.push("Phone number is required.");
      if (!city) errors.push("City is required.");
      if (!country) errors.push("Address is required.");

      // Kiểm tra email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (email && !emailRegex.test(email)) {
          errors.push("Invalid email format.");
      }

      // Kiểm tra số điện thoại (chỉ chứa số)
      const phoneRegex = /^[0-9]+$/;
      if (phone && !phoneRegex.test(phone)) {
          errors.push("Phone number must contain only digits.");
      }

      // Hiển thị lỗi và ngăn gửi form nếu có lỗi
      if (errors.length > 0) {
          e.preventDefault();
          alert(errors.join("\n"));
      }
    });


    document.getElementById('addUserForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn gửi form mặc định

        const formData = new FormData(this);
        
        fetch('http://localhost/admin/handleUserAdd', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
              Swal.fire({
                title: 'Inserted successfully!',
                text: 'Press the button to reload the table',
                icon: 'success',
                confirmButtonText: 'YES',
              }).then(response => {
                if(response.isConfirmed) {
                  location.reload();
                }
              })
                // Tải lại danh sách người dùng
                
            } else {
              Swal.fire({
                title: 'Error',
                text: 'Inserted Failed!',
                icon: 'error',
                confirmButtonText: 'Try again',
              });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred.');
        });
    });
    

    // Select All Checkbox
    document.getElementById('selectAllCheckbox').addEventListener('change', function () {
    const checkboxes = document.querySelectorAll('.rowCheckbox');
    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    // Delete Selected
    document.getElementById('deleteSelectedBtn').addEventListener('click', function () {
    const selectedIds = Array.from(document.querySelectorAll('.rowCheckbox:checked')).map(checkbox => checkbox.value);
        if (selectedIds.length === 0) {
          Swal.fire({
            title: 'Select an item',
            text: 'You need to select an item to delete!',
            icon: 'error',
            confirmButtonText: 'Try again',
          })
            return;
        } else {
          Swal.fire({
              title: 'Warning!',
              text: 'Are you sure you want to delete the selected users?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes',
              cancelButtonText: 'No'
          })
          .then((result) => {
              if(result.isConfirmed) {
                fetch('http://localhost/admin/handleUserDelete', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ user_ids: selectedIds }),
                })
                .then(async response => {
                  const data = await response.json();
                  console.log(data);
                  return data;
                })
                .then(data => {
                    if (data.success) {
                      Swal.fire({
                        title: 'Success!',
                        text: 'Deleted successfully!',
                        icon: 'success',
                        confirmButtonText: 'Yes'
                      }).then((response) => {
                        if(response.isConfirmed)
                          location.reload();
                      })
                        
                    } else {
                      Swal.fire({
                        title: 'Error',
                        text: 'Error deleting users.',
                        icon: 'error',
                        confirmButtonText: 'Try again',
                      });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Error deleting users.',
                        icon: 'error',
                        confirmButtonText: 'Try again',
                    });
                });
              }
          }) 
        }
    });


    // Populate Edit Modal
    $('editUserForm').click (function (event) {
        event.preventDefault(); // Ngăn gửi form mặc định

        const formData = new FormData(this);
        
        fetch('http://localhost/admin/handleUserEdit', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
              Swal.fire({
                title: 'Inserted successfully!',
                text: 'Press the button to reload the table',
                icon: 'success',
                confirmButtonText: 'YES',
              }).then(response => {
                if(response.isConfirmed) {
                  location.reload();
                }
              })
            } else {
              Swal.fire({
                  title: 'Error',
                  text: 'Error editing users.',
                  icon: 'error',
                  confirmButtonText: 'Try again',
              });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                  title: 'Error',
                  text: 'Error editing users.',
                  icon: 'error',
                  confirmButtonText: 'Try again',
              });
        });
    });

</script>
<?php
include "layouts/footer.php";
?>