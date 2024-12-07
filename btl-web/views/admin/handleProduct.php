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
                    <h4 class="card-title">Products List
                        <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#addProductModal">
                        Add Product
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
                          <th>Title</th>
                          <th>Category</th>
                          <th>Brand</th>
                          <th>Price</th>
                          <th>Sale</th>
                          <th>Description</th>
                          <th>Image</th>
                          <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 
                          while(list($id,$title,$category,$brand,$price,$sale,$desc, $img)=mysqli_fetch_array($all_products)) { 
                              echo "
                              <tr>
                              <td><input type='checkbox' class='rowCheckbox' value='$id'></td>
                              <td>$id</td>
                              <td>$title</td>
                              <td>$category</td>
                              <td>$brand</td>
                              <td>$price</td>
                              <td>$sale</td>
                              <td>$desc</td>
                              <td>$img</td>
                              <td>
                                  <button type='button' style='background-color: #007bff' class='btn btn-sm editBtn' data-id='$id' data-toggle='modal' data-target='#editUserModal'>Edit</button>
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
              <!-- Pagination -->
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

            <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editProductForm" method="post">
                                <input style="padding-left: 10px;" type="hidden" name="id" id="editProductId">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Title</label>
                                            <input style="padding-left: 10px;" type="text" id="editTitle" value="1" name="title" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Category</label>
                                            <select style="padding-left: 10px;" name="category" id="category" class="form-control" required>
                                                <option value="" disabled selected>Select a category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?= htmlspecialchars($category['cat_id']) ?>">
                                                        <?= htmlspecialchars($category['cat_title']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>                                        
                                          </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Brand</label>
                                            <select style="padding-left: 10px;" name="brand" id="brand" class="form-control" required>
                                              <option disabled value="" selected>Select a brand</option>
                                              <?php foreach ($brands as $brand): ?>
                                                  <option style="padding-left: 10px" value="<?= htmlspecialchars($brand['brand_id']) ?>">
                                                      <?= htmlspecialchars($brand['brand_title']) ?>
                                                  </option>
                                              <?php endforeach; ?>
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Price</label>
                                            <input style="padding-left: 10px;" type="number" id="editPrice" value="1" name="price" class="form-control" required step="0.01" min="0.01" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Sale</label>
                                            <input style="padding-left: 10px;" type="number" id="editSale" value="1" name="sale" class="form-control" required step="0.01" min="0.01" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Image URL</label>
                                            <input style="padding-left: 10px;" type="text" id="editImg" value="1" name="img" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group bmd-form-group">
                                            <label class="bmd-label-floating">Description</label>
                                            <input style="padding-left: 10px;" type="text" id="editDesc" value="1" name="desc" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


          <div class="col-md-12">
          <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
              <div class="modal-dialog-centered modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <form id="addProductForm" action="" method="post" name="form" enctype="multipart/form-data">
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group bmd-form-group">
                                          <label class="bmd-label-floating">Title</label>
                                          <input style="padding-left: 10px;"  type="text" style="color: #000;" id="title" name="title" class="form-control" required>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group bmd-form-group">
                                          <label class="bmd-label-floating">Category</label>
                                          <select style="padding-left: 10px;" name="category" id="category" class="form-control" required>
                                                <option value="" disabled selected>Select a category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?= htmlspecialchars($category['cat_id']) ?>">
                                                        <?= htmlspecialchars($category['cat_title']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                          </select>                                           
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group bmd-form-group">
                                          <label class="bmd-label-floating">Brand</label>
                                          <select style="padding: 10px; color: #495057; background-color: #fff; font-size: 16px; width: 100%;" name="brand" id="brand" class="form-control" required>
                                              <option disabled value="" selected>Select a brand</option>
                                              <?php foreach ($brands as $brand): ?>
                                                  <option value="<?= htmlspecialchars($brand['brand_id']) ?>">
                                                      <?= htmlspecialchars($brand['brand_title']) ?>
                                                  </option>
                                              <?php endforeach; ?>
                                          </select>                                      
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group bmd-form-group">
                                          <label class="bmd-label-floating">Price</label>
                                          <input style="padding-left: 10px;" type="number" style="color: #000;" name="price" id="price" class="form-control" required step="0.01" min="0.01" required>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group bmd-form-group">
                                          <label class="bmd-label-floating">Sale</label>
                                          <input style="padding-left: 10px;" type="number" style="color: #000;" name="sale" id="sale" class="form-control" required step="0.01" min="0.01" required>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group bmd-form-group">
                                          <label class="bmd-label-floating">Image URL</label>
                                          <input style="padding-left: 10px;" type="text" style="color: #000;" name="img" id="image" class="form-control" required>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group bmd-form-group">
                                          <label class="bmd-label-floating">Description</label>
                                          <input style="padding-left: 10px;" type="text" style="color: #000;" name="desc" id="description" class="form-control" required>
                                      </div>
                                      
                                  </div>
                              </div>
                              <button type="submit" name="btn_save" id="btn_save" class="btn btn-success pull-right">Add Product</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>

          </div>
        </div>
      </div>

<script>

    // Add Product

    document.getElementById('addProductForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Ngăn hành động gửi mặc định

        const title = document.getElementById('title').value.trim();
        const category = document.getElementById('category').value.trim();
        const brand = document.getElementById('brand').value.trim();
        const price = document.getElementById('price').value.trim();
        const sale = document.getElementById('sale').value.trim();
        const image = document.getElementById('image').value.trim();
        const description = document.getElementById('description').value.trim();

        let errors = [];

        // Kiểm tra các trường không được để trống
        if (!title) errors.push("Title is required.");
        if (!category) errors.push("Category is required.");
        if (!brand) errors.push("Brand is required.");
        if (!price) {
            errors.push("Price is required.");
        } else if (isNaN(price) || parseFloat(price) <= 0) {
            errors.push("Price must be a valid number greater than 0.");
        }

        if (!sale) {
            errors.push("Sale is required.");
        } else if (isNaN(sale) || parseFloat(sale) < 0) {
            errors.push("Sale must be a valid number greater than or equal to 0.");
        } 

        if (!image) errors.push("Image URL is required.");
        if (!description) errors.push("Description is required.");

        // Hiển thị lỗi và ngăn gửi form nếu có lỗi
        if (errors.length > 0) {
            e.preventDefault();
            Swal.fire({
                title: 'Validation Error',
                text: errors.join("\n"),
                icon: 'error',
                confirmButtonText: 'OK',
            });
        }

        const formData = new FormData(this);

        fetch('http://localhost/admin/handleProduct/add', {
            method: 'POST',
            body: formData,
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
                        if (response.isConfirmed) {
                            // location.reload(); // Reload trang để cập nhật dữ liệu
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
                    text: 'An unexpected error occurred!',
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
              text: 'Are you sure you want to delete the selected products?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Yes',
              cancelButtonText: 'No'
          })
          .then((result) => {
              if(result.isConfirmed) {
                fetch('http://localhost/admin/handleProduct/delete', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ ids: selectedIds }),
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
                        text: 'Error deleting products.',
                        icon: 'error',
                        confirmButtonText: 'Try again',
                      });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Error deleting products.',
                        icon: 'error',
                        confirmButtonText: 'Try again',
                    });
                });
              }
          }) 
        }
    });

    // EDIT
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function () {
            // Lấy thông tin sản phẩm từ thuộc tính data-id
            const productId = this.getAttribute('data-id');
            const row = this.closest('tr');
            const title = row.cells[2].textContent;
            const category = row.cells[3].textContent;
            const brand = row.cells[4].textContent;
            const price = row.cells[5].textContent;
            const sale = row.cells[6].textContent;
            const desc = row.cells[7].textContent;
            const img = row.cells[8].textContent;

            // Cập nhật giá trị vào form modal
            document.getElementById('editProductId').value = productId;
            document.getElementById('editTitle').value = title;
            document.getElementById('editCategory').value = category;
            document.getElementById('editBrand').value = brand;
            document.getElementById('editPrice').value = price;
            document.getElementById('editSale').value = sale;
            document.getElementById('editDesc').value = desc;
            document.getElementById('editImg').value = img;
        });
    });

    document.getElementById('editProductForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Ngừng gửi form mặc định

        const productId = document.getElementById('editProductId').value;
        const title = document.getElementById('editTitle').value.trim();
        const category = document.getElementById('editCategory').value.trim();
        const brand = document.getElementById('editBrand').value.trim();
        const price = document.getElementById('editPrice').value.trim();
        const sale = document.getElementById('editSale').value.trim();
        const desc = document.getElementById('editDesc').value.trim();
        const img = document.getElementById('editImg').value.trim();

        let errors = [];

        // Kiểm tra các trường bắt buộc
        if (!title) errors.push("Title is required.");
        if (!category) errors.push("Category is required.");
        if (!brand) errors.push("Brand is required.");
        if (!price) errors.push("Price is required.");
        if (!sale) errors.push("Sale is required.");
        if (!desc) errors.push("Description is required.");

        // Nếu có lỗi, thông báo và dừng gửi form
        if (errors.length > 0) {
            alert(errors.join("\n"));
            return;
        }

        const formData = new FormData(this);

        fetch('http://localhost/admin/handleProduct/edit', {
            method: 'POST',
            body: formData
        })
        .then(response => {return response.json()})
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Updated successfully!',
                    text: data.message,
                    icon: 'success',
                    confirmButtonText: 'Yes',
                }).then((response) => {
                    if (response.isConfirmed) {
                        location.reload(); // Reload trang để cập nhật dữ liệu
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
                text: 'An error occurred while updating the product.',
                icon: 'error',
                confirmButtonText: 'Try again',
            });
        });
    });



</script>
<?php
include "layouts/footer.php";
?>