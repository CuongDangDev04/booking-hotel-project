# booking-hotel-project

## Giới thiệu dự án

booking-hotel-project là một ứng dụng web được xây dựng trên nền tảng Laravel, cho phép người dùng đặt phòng khách sạn trực tuyến. Dự án cung cấp các chức năng như tìm kiếm khách sạn, đặt phòng, quản lý đặt phòng, quản trị khách sạn và người dùng và thanh toán bằng VietQR.

## Tính năng chính

- Đăng ký, đăng nhập người dùng
- Tìm kiếm và xem thông tin khách sạn, phòng
- Đặt phòng khách sạn trực tuyến
- Quản lý đặt phòng cho người dùng
- Quản trị khách sạn, phòng, đơn đặt phòng (dành cho admin)
- Giao diện thân thiện, dễ sử dụng
- Thanh toán bằng VietQR

## Yêu cầu hệ thống

- PHP >= 8.0
- Composer
- MySQL 
- Node.js & npm 
- Laravel 

## Hướng dẫn cài đặt và chạy dự án

### 1. Clone source code

```bash
git clone <đường dẫn repo>
cd BookingHotel_Web/Project/Project
```

### 2. Cài đặt các thư viện PHP

```bash
composer install
```

### 3. Cài đặt các thư viện frontend 

```bash
npm install
npm run dev
```

### 4. Tạo file cấu hình môi trường

```bash
cp .env.example .env
```

Sau đó chỉnh sửa file `.env` cho phù hợp với cấu hình database của bạn.

### 5. Tạo key ứng dụng

```bash
php artisan key:generate
```

### 6. Chạy migration và seed database (nếu có)

```bash
php artisan migrate --seed
```

### 7. Khởi động server

```bash
php artisan serve
```

