<?php
include "layouts/sidenav.php";
include "layouts/topheader.php";

?>

<!-- Giao diện -->
<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">News List
            <button type="button" id="deleteSelectedBtn" class="btn btn-danger float-right">
              Delete Selected
            </button>
            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addNewsModal">
              Add News
            </button>

          </h4>
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table table-hover tablesorter">
              <thead class="text-primary">
                <tr>
                  <th>
                    <input type="checkbox" id="selectAllCheckbox">
                  </th>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Subtitle</th>
                  <th>Content</th>
                  <th>Category</th>
                  <th>UploadDate</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $row): ?>
                  <tr>
                    <td>
                      <input type="checkbox" class="rowCheckbox" value="<?php echo $row['id']; ?>">
                    </td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['subtitle']; ?></td>
                    <td><?php echo $row['content']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['upload_date']; ?></td>
                    <td>
                      <button type="button" class="btn btn-sm btn-primary editBtn" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#editNewsModal">Edit</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Phân trang -->
      <nav>
        <ul class="pagination">
          <?php
          $maxPagesToShow = 10;
          $startPage = max(1, $page - floor($maxPagesToShow / 2));
          $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);

          if ($page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
            </li>
          <?php else: ?>
            <li class="page-item disabled"><a class="page-link">Previous</a></li>
          <?php endif; ?>

          <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
              <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>

          <?php if ($page < $totalPages): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
            </li>
          <?php else: ?>
            <li class="page-item disabled"><a class="page-link">Next</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Modal thêm tin tức -->
<div class="modal fade" id="addNewsModal" tabindex="-1" aria-labelledby="addNewsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add News</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addNewsForm" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Content</label>
            <textarea name="content" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal chỉnh sửa tin tức -->
<div class="modal fade" id="editNewsModal" tabindex="-1" aria-labelledby="editNewsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit News</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editNewsForm" method="post">
          <input type="hidden" name="id" id="editNewsId">
          <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" id="editTitle" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Subtitle</label>
            <input type="text" name="subtitle" id="editSubtitle" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Content</label>
            <textarea name="content" id="editContent" class="form-control" required></textarea>
          </div>  
          <div class="form-group">
            <label>Category</label>
            <input type="text" name="category" id="editCategory" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
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
    // Chọn tất cả các checkbox
    document.getElementById('selectAllCheckbox').addEventListener('change', function () {
        const isChecked = this.checked;
        const checkboxes = document.querySelectorAll('.rowCheckbox');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = isChecked;
        });
    });

    // Kiểm tra trạng thái khi checkbox từng dòng được thay đổi
    document.querySelectorAll('.rowCheckbox').forEach((checkbox) => {
        checkbox.addEventListener('change', function () {
            const allCheckboxes = document.querySelectorAll('.rowCheckbox');
            const allChecked = Array.from(allCheckboxes).every((cb) => cb.checked);
            document.getElementById('selectAllCheckbox').checked = allChecked;
        });
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