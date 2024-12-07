<?php
include "layouts/sidenav.php";
include "layouts/topheader.php";

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
                          <th>Contact</th>
                          <th>Address</th>
                          <th>District</th>
                          <th>Province</th>
                          <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                          while(list($user_id,$first_name,$last_name,$email,$password,$phone,$address, $district, $province)=mysqli_fetch_array($all_users)) { 
                              echo "
                              <tr>
                              <td><input type='checkbox' class='rowCheckbox' value='$user_id'></td>
                              <td>$user_id</td>
                              <td>$first_name</td>
                              <td>$last_name</td>
                              <td>$email</td>
                              <td>$phone</td>
                              <td>$address</td>
                              <td>$district</td>
                              <td>$province</td>
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

              <nav>                      
                <ul class="pagination">
                    <?php
                    // Số trang muốn hiển thị
                    $maxPagesToShow = 10;

                    // Tìm trang bắt đầu và trang kết thúc để hiển thị
                    $startPage = max(1, $page - floor($maxPagesToShow / 2));
                    $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);

                    // Điều chỉnh lại nếu $endPage bị lệch so với tổng số trang
                    if ($endPage - $startPage + 1 < $maxPagesToShow) {
                        $startPage = max(1, $endPage - $maxPagesToShow + 1);
                    }
                    ?>

                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                        </li>
                    <?php else: ?>
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
              </nav>
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
                    <input type="hidden" style="color: #000;" name="user_id" id="editUserId">
                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">First Name</label>
                          <input type="text" id="editFirstName" style="color: #000;" value="1" name="first_name" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Last Name</label>
                          <input type="text" style="color: #000;" value="1" name="last_name" id="editLastName"  class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" style="color: #000;" value="1" name="email" id="editEmail" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Phone Number</label>
                          <input type="text" id="editPhone" style="color: #000;" value="1" name="phone" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Address</label>
                          <input type="text" style="color: #000;" value="1" name="address" id="editAddress" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">District</label>
                          <input type="text" style="color: #000;" value="1" name="district" id="editDistrict"  class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group bmd-form-group">
                          <label class="bmd-label-floating">Province</label>
                          <input type="text" style="color: #000;" value="1" name="province" id="editProvince" class="form-control" required>
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
                            <input type="text" style="color: #000;" id="first_name" name="first_name" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Last Name</label>
                            <input type="text" style="color: #000;" name="last_name" id="last_name"  class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Email</label>
                            <input type="email" style="color: #000;" name="email" id="email" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Password</label>
                            <input type="password" id="password" style="color: #000;" name="password" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Phone Number</label>
                            <input type="text" id="phone" style="color: #000;" name="phone" class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Address</label>
                            <input type="text" style="color: #000;" name="address" id="address" class="form-control" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">District</label>
                            <input type="text" style="color: #000;" name="district" id="district"  class="form-control" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">Province</label>
                            <input type="text" style="color: #000;" name="province" id="province" class="form-control" required>
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
    e.preventDefault(); // Ngăn việc gửi form mặc định

    // Lấy giá trị từ các trường input
    const firstName = document.getElementById('first_name').value.trim();
    const lastName = document.getElementById('last_name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const address = document.getElementById('address').value.trim();
    const district = document.getElementById('district').value.trim();
    const province = document.getElementById('province').value.trim();

    let errors = [];

    // Kiểm tra các trường không được để trống
    if (!firstName) errors.push("First Name is required.");
    if (!lastName) errors.push("Last Name is required.");
    if (!email) errors.push("Email is required.");
    if (!password) errors.push("Password is required.");
    if (!phone) errors.push("Phone number is required.");
    if (!address) errors.push("Address is required.");
    if (!district) errors.push("District is required.");
    if (!province) errors.push("Province is required.");

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

    // Nếu có lỗi, hiển thị thông báo lỗi
    if (errors.length > 0) {
        Swal.fire({
            title: 'Error',
            text: errors.join("\n"),
            icon: 'error',
            confirmButtonText: 'Try again',
        });
        return; // Ngừng xử lý tiếp tục
    }

    // Nếu không có lỗi, gửi dữ liệu form qua fetch
    const formData = new FormData(this);
    fetch('http://localhost/admin/handleUser/add', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'Inserted successfully!',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'YES',
            }).then(response => {
                if(response.isConfirmed) {
                    location.reload();
                    document.getElementById('addUserForm').reset();
                }
            });
        } else {
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
            text: 'An error occured!',
            icon: 'error',
            confirmButtonText: 'Try again',
        });
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
                fetch('http://localhost/admin/handleUser/delete', {
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


    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            // Get user data from data attributes
            const userId = this.getAttribute('data-id');
            const row = this.closest('tr');
            const firstName = row.cells[2].textContent;
            const lastName = row.cells[3].textContent;
            const email = row.cells[4].textContent;
            const phone = row.cells[5].textContent;
            const address = row.cells[6].textContent;
            const district = row.cells[7].textContent;
            const province = row.cells[8].textContent;

            // Set values in the modal form
            document.getElementById('editUserId').value = userId;
            document.getElementById('editFirstName').value = firstName;
            document.getElementById('editLastName').value = lastName;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPhone').value = phone;
            document.getElementById('editAddress').value = address;
            document.getElementById('editDistrict').value = district;
            document.getElementById('editProvince').value = province;
        });
    });


    document.getElementById('editUserForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const userId = document.getElementById('editUserId').value;
        const firstName = document.getElementById('editFirstName').value.trim();
        const lastName = document.getElementById('editLastName').value.trim();
        const email = document.getElementById('editEmail').value.trim();
        const phone = document.getElementById('editPhone').value.trim();
        const address = document.getElementById('editAddress').value.trim();
        const district = document.getElementById('editDistrict').value.trim();
        const province = document.getElementById('editProvince').value.trim();

        let errors = [];

        // Validate required fields
        if (!firstName) errors.push("First Name is required.");
        if (!lastName) errors.push("Last Name is required.");
        if (!email) errors.push("Email is required.");
        if (!phone) errors.push("Phone number is required.");
        if (!address) errors.push("Address is required.");
        if (!district) errors.push("District is required.");
        if (!province) errors.push("Province is required.");

        // Validate email format
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) {
            errors.push("Invalid email format.");
        }

        // Validate phone number (only digits)
        const phoneRegex = /^[0-9]+$/;
        if (phone && !phoneRegex.test(phone)) {
            errors.push("Phone number must contain only digits.");
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
        fetch('http://localhost/admin/handleUser/edit', {
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
                text: 'An error occurred while updating the user.',
                icon: 'error',
                confirmButtonText: 'Try again',
            });
        });
    });
</script>
<?php
include "layouts/footer.php";
?>