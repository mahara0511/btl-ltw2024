- Phiên bản hỗ trợ: PHP 8.0.30.
- Môi trường chạy: XAMPP.
- Bước 1: Cài đặt XAMPP từ trang web https://www.apachefriends.org/download.html
#Bước 2: Cài đặt XAMPP vào máy bằng cách chạy file exe vừa tải về.
#Bước 3: Truy cập vào github: https://github.com/mahara0511/btl-ltw2024
#Bước 4: Clone dự án từ nhánh main về lưu vào một thư mục.
#Bước 5: Mở Xampp đã cài đặt xong lên, khởi động mysql, bấm vào nút admin.
#Bước 6: Tạo một cơ sở dữ liệu mới tên là onlineshop.
#Bước 7: Chuyển sang phần nhập(Import) và thêm file NEW_shopping_online.sql.
#Bước 8: Cấu hình lại web root:
##-Mở thư mục xampp/apache/conf/httpd.conf
##-Thay đổi đường dẫn ở dòng DocumentRoot "C:/xampp/htdocs" thành đường dẫn mà thư mục được tải về.
##.Thay đổi đường dẫn ở dòng <Directory "C:/xampp/htdocs" > thành đường dẫn mà thư mục được tải về.
#Bước 9: Khởi động apache và nhấn admin.
#Bước 10: Tham quan web site, có thể đăng nhập bằng admin với username = admin@gmail.com và password = admin123
