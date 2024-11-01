<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(ROOT_PATH."/component/head.php"); ?>
    <title>Show Product</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .custom-table thead {
            background-color: #1976d2;
            color: white;
        }
        .custom-table tbody tr:hover {
            background-color: #e3f2fd;
        }
        .custom-table tbody td {
            padding: 15px 10px;
        }
        .custom-table .material-icons {
            vertical-align: middle;
            margin-right: 5px;
        }
        .custom-table tbody tr:nth-child(odd) {
            background-color: #f5f5f5;
        }

        th:nth-child(1), td:nth-child(1) {
            width: 10%; /* Đặt độ rộng cho cột đầu tiên */
        }

        th:nth-child(2), td:nth-child(2) {
            width: 15%; /* Đặt độ rộng cho cột thứ hai */
        }

        th:nth-child(3), td:nth-child(3) {
            width: 40%; /* Đặt độ rộng cho cột thứ ba */
        }

        th:nth-child(4), td:nth-child(4) {
            width: 12%; /* Đặt độ rộng cho cột thứ tư */
        }

        th:nth-child(5), td:nth-child(5) {
            width: 20%; /* Đặt độ rộng cho cột thứ năm */
        }

        .description {
            width: 100%;
            line-height: 20px;
            font-size: 16px;
            max-height: 60px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-line-clamp: 3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4 class="center-align">Các sản phẩm hiện có</h4>
        <a href='/product/add' class='btn green'>Thêm sản phẩm mới!</a>
        <table class="highlight striped responsive-table custom-table" style="margin-top: 10px">
            <thead>
                <tr>
                    <th>id</th>                    
                    <th><i class="material-icons">shopping_cart</i> Tên sản phẩm</th>
                    <th><i class="material-icons">event</i> Mô tả</th>
                    <th><i class="material-icons">monetization_on</i> Giá tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr id="no-data-message">
                        <td colspan="5" class="center-align"></td>
                </tr>
            
            
            </tbody>
        </table>
    </div>

    <?php require_once(ROOT_PATH."/component/script_config.php") ?> 
    <script>
        // Dữ liệu mẫu tương tự như dữ liệu từ cơ sở dữ liệu

        const apiUri = 'http://localhost/api/product/getAllProduct';
        const tableBody = document.getElementById('table-body');
        const noDataMessage = document.getElementById('no-data-message');
        fetch(apiUri, {
            method: 'GET',
        })
            .then(response => {
                if(!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                } 
                return response.json();
            })
            .then(data => {
                tableBody.innerHTML = "";
                if (!data || data.length === 0) {
                    noDataMessage.style.display = "table-row";
                    noDataMessage.innerHTML = "<td colspan='5' class='center-align'>Không có data nào</td>";
                } else {
                    noDataMessage.style.display = "none";
                    data.forEach(row => {
                        const tr = document.createElement('tr');
                        tr.innerHTML =  `
                                        <td>${row.id}</td>
                                        <td>${row.name}</td>
                                        <td><span class='description'>${row.description}</span></td>
                                        <td>${row.price}</td>
                                        <td>
                                            <a href='edit?id=${row.id}' class='btn blue'>Sửa!</a>
                                            <a href='api/product/get?id=${row.id}' class='btn red'>Xóa!</a>
                                        </td>
                                    `;
                        tableBody.appendChild(tr);
                    })
                }})
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
                noDataMessage.innerHTML = "<td colspan='5' class='center-align'>Lỗi khi tải dữ liệu</td>";
                noDataMessage.style.display = "table-row";
            });

    </script>
</body>
</html>
