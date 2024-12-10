<?php
include "layouts/sidenav.php";
include "layouts/topheader.php";
?>
<div class="content">
    <div class="container-fluid">
        <div class="col-md-14">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Products List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table tablesorter" id="page1">
                            <thead class="text-primary">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th><a class="btn btn-primary" href="handleProduct/add">Add New</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $products->fetch_assoc()) { ?>
                                    <tr>
                                        <td><img src="../../../public/product_images/<?php echo $row['product_image']; ?>" style="width:50px; height:50px; border:groove #000"></td>
                                        <td><?php echo $row['product_title']; ?></td>
                                        <td><?php echo $row['product_price']; ?></td>
                                        <td>
                                            <a class="btn btn-success" href="handleProduct/delete?product_id=<?php echo $row['product_id']; ?>&action=delete&page=<?php echo $page?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <?php
                $maxPagesToShow = 12;
                $startPage = max(1, $page - floor($maxPagesToShow / 2));
                $totalPages = ceil($total/$maxPagesToShow);
                $endPage = min($totalPages, $startPage + $maxPagesToShow - 1);
                
                // Previous button
                if ($page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                  </li>
                <?php else: ?>
                  <li class="page-item disabled"><a class="page-link">Previous</a></li>
                <?php endif; ?>

                <?php
                // Loop through pages and display page links
                for ($i = $startPage; $i <= $endPage; $i++):
                ?>
                  <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                  </li>
                <?php endfor; ?>

                <!-- Next button -->
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

<?php
include "layouts/footer.php";
?>