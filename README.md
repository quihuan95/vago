# VAGO Website (Laravel + Filament + Tailwind)

Website chính thức **Hội Phụ sản Việt Nam (VAGO)** — CMS song ngữ Việt/Anh theo brief `AI/brief-ai-code-website-vago.md`.

## Stack

- PHP 8.3+, Laravel 13
- Filament 5 (admin `/admin`)
- Blade + Vite + Tailwind 4
- SQLite mặc định (có thể đổi MySQL trong `.env`)

## Chạy local

```bash
composer install
cp .env.example .env   # nếu chưa có
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm install
npm run build
php artisan serve
```

- Website: http://127.0.0.1:8000  
- Admin: http://127.0.0.1:8000/admin  
  - Email: `admin@vago.vn`  
  - Password: `password`

Dev assets:

```bash
npm run dev
```

## Sitemap frontend

| Route | Mô tả |
|-------|--------|
| `/` | Trang chủ (slider, tin nổi bật, thông báo, VAGO 2026) |
| `/gioi-thieu/gioi-thieu-chung` | Giới thiệu chung |
| `/gioi-thieu/thu-chu-tich` | Thư Chủ tịch |
| `/gioi-thieu/ban-chap-hanh` | Ban Chấp hành |
| `/dao-tao` | Đào tạo |
| `/hoi-vien/the-le` | Thể lệ hội viên |
| `/hoi-vien/dang-ky` | Form đăng ký hội viên |
| `/thu-vien` | Thư viện ảnh (album) |
| `/tin-tuc-thong-bao/thong-bao` | Thông báo |
| `/tin-tuc-thong-bao/hoat-dong` | Hoạt động |
| `/lien-he` | Liên hệ |
| `/tim-kiem` | Tìm kiếm |
| `/vago-2026` | Redirect microsite (cấu hình trong Settings) |
| `/tap-chi-vago` | Redirect `https://vjog.vn/journal` |
| `/sitemap.xml` | Sitemap XML |

## Admin CMS

Quản lý: trang tĩnh, bài viết, danh mục, banner, album, Ban Chấp hành, đào tạo, đơn hội viên (xuất CSV), liên hệ, cài đặt website (logo, SEO, link VAGO 2026 / Tạp chí, email nhận form…).

## Ghi chú

- Nội dung “cập nhật sau” trong brief đã có schema + UI placeholder.
- URL microsite VAGO 2026 và SMTP cần xác nhận trước khi production.
- Đổi mật khẩu admin ngay sau khi deploy.
