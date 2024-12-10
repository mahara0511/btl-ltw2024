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

                  <th>Title</th>
                  <th>Subtitle</th>
                  <th>Content</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th colspan="2" style="text-align: center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $row): ?>
                  <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['subtitle']; ?></td>
                    <td><?php echo $row['content']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><img src="../../../public/img/<?php echo $row['img']; ?>" style="width:50px; height:50px; border:groove #000"></td>

                    <td>
                        <a class="btn btn-sm btn-danger" href="news/delete?id=<?php echo $row['id']; ?>&action=delete&page=<?php echo $page?>">Delete</a>
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
        <form id="addNewsForm" method="post" action="/admin/news/add" enctype="multipart/form-data">
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
          <div class="">
            <label for="">Add Image</label>
            <input type="file" name="picture" required class="btn btn-fill btn-primary" id="picture" >
          </div>

          <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include "layouts/footer.php";
?>