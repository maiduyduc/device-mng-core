
# Web quản lý trang thiết bị khoa CNTT trường CĐN Bách Khoa Hà Nội



## Hướng dẫn cài đặt

Hãy chắc chắn máy tính của bạn đã được cài đặt các phần mềm sau:
### Windows
- [Xampp](https://www.apachefriends.org/download.html)
- [Git](https://git-scm.com/downloads)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://www.npmjs.com/get-npm)

### Ubuntu
- [Xampp](https://www.apachefriends.org/download.html)
- [Git](https://git-scm.com/download/linux)
- [Composer](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)
- [Node.js](https://www.digitalocean.com/community/tutorials/how-to-install-node-js-on-ubuntu-18-04)

###
Nếu bạn đã cài đặt các phần mềm trên, hãy làm tiếp các bước sau đây.
###

### Tạo 1 database mới với tên **device-mng-core**

*Hướng dẫn dưới đây dành cho người sử dụng Xampp*

Truy cập vào thư mục htdocs, mở gitbash hoặc cmd và thực thi lần lượt các lệnh sau:

Sao chép dự án về máy

```bash
  git clone https://github.com/maiduyduc/device-mng-core.git
```

Truy cập vào thư gốc của dự án

```bash
  cd device-mng-core
```

Cài đặt Composer

```bash
  composer install
```

Cài đặt Node.js

```bash
  npm install
  npm run dev
```

Khởi tạo khóa ứng dụng

```bash
  php artisan key:generate
```

Khởi tạo table và dữ liệu mẫu

```bash
  php artisan migrate:fresh --seed
```

Chạy serve

```bash
  php artisan serve
```

Truy cập vào http://localhost:8000/ hoặc http://127.0.0.1:8000 và đăng nhập với thông tin:

```bash
  Quyền tài khoản admin: chỉnh sửa người dùng, menu, phân quyền, sao lưu phục hồi,
  ----------------
  Email: admin@admin
  Password: 123
```
```bash
  Quyền tài khoản ktv, ptb, trk: xem, thêm, sửa, xóa các văn bản được phép
  ----------------
  Email: ktv@ktv
  Password: 123
  ----------------
  Email: ptb@ptb
  Password: 123
  ----------------
  Email: trk@trk
  Password: 123
```

*Nếu xuất hiện lỗi sai tài khoản/ mật khẩu hãy thử tạo lại dữ liệu mẫu*
## Authors

- [@maiduyduc](https://www.github.com/maiduyduc)
- [@sansan22032000](https://github.com/sansan22032000)
- [@Hung141220](https://github.com/Hung141220)

  
