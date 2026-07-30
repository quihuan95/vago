# BRIEF YÊU CẦU AI CODE WEBSITE VAGO

## 1. Tổng quan dự án

- Xây dựng website chính thức cho **Hội Sản Phụ khoa Việt Nam (VAGO)**.
- Website dùng để:
  - Giới thiệu thông tin về Hội.
  - Đăng tải tin tức, thông báo và hoạt động.
  - Quản lý nội dung đào tạo, hội viên, thư viện ảnh.
  - Chuyển hướng người dùng sang website Hội nghị VAGO 2026.
  - Chuyển hướng người dùng sang website Tạp chí VAGO.
  - Tiếp nhận đăng ký hội viên và liên hệ.
- Website hỗ trợ **song ngữ Việt – Anh**.
- Giao diện cần hiển thị tốt trên desktop, tablet và mobile.

---

## 2. Cấu trúc menu và sitemap

### 2.1. Trang chủ

Đường dẫn đề xuất:

```text
/
```

### 2.2. Giới thiệu

Menu cha: **Giới thiệu**

Các trang con:

```text
/gioi-thieu/gioi-thieu-chung
/gioi-thieu/thu-chu-tich
/gioi-thieu/ban-chap-hanh
```

### 2.3. VAGO 2026

- Menu **VAGO 2026** không cần xây dựng trang nội dung riêng.
- Khi click, chuyển hướng sang microsite Hội nghị VAGO 2026.
- Link trong brief: `vago2026.websitehoinghi` nhưng chưa có tên miền hoàn chỉnh, cần xác nhận URL chính thức.

### 2.4. Đào tạo

```text
/dao-tao
```

- Nội dung sẽ cập nhật sau.
- Giai đoạn đầu có thể hiển thị trang danh sách trống hoặc trạng thái “Nội dung đang được cập nhật”.

### 2.5. Hội viên

Menu cha: **Hội viên**

Các trang con:

```text
/hoi-vien/the-le
/hoi-vien/dang-ky
```

- Trang **Thể lệ đăng ký hội viên**: nội dung cập nhật sau.
- Trang **Đăng ký hội viên**: tạo form đăng ký, trường dữ liệu sẽ cập nhật sau.

### 2.6. Tạp chí VAGO

- Khi click, chuyển hướng sang:

```text
https://vjog.vn/journal
```

### 2.7. Thư viện ảnh

```text
/thu-vien
/thu-vien/{album-slug}
```

- Tham khảo cấu trúc hiện tại tại:
  - `https://vago-hq.vn/galleries/vago`
- Giai đoạn đầu giữ cách tổ chức tương tự website cũ.
- Giao diện mới cần hiển thị danh sách album dạng card.

### 2.8. Tin tức – Thông báo

Menu cha: **Tin tức – Thông báo**

Các nhóm nội dung:

```text
/tin-tuc-thong-bao/thong-bao
/tin-tuc-thong-bao/hoat-dong
/tin-tuc-thong-bao/{slug}
```

### 2.9. Liên hệ

```text
/lien-he
```

---

## 3. Yêu cầu chức năng toàn website

### 3.1. Song ngữ Việt – Anh

- Có nút chuyển đổi ngôn ngữ Việt/Anh trên header.
- Mỗi bài viết, trang tĩnh, album và nội dung menu cần có dữ liệu theo từng ngôn ngữ.
- Khi chuyển ngôn ngữ, người dùng vẫn ở đúng trang tương ứng.
- Nếu nội dung tiếng Anh chưa có, cần có cơ chế fallback hoặc thông báo nội dung đang cập nhật.

### 3.2. Tìm kiếm

- Có thanh tìm kiếm trên website.
- Cho phép tìm kiếm tối thiểu trong:
  - Tin tức.
  - Thông báo.
  - Hoạt động.
  - Nội dung giới thiệu.
  - Đào tạo.
  - Album thư viện ảnh.
- Trang kết quả cần hiển thị:
  - Tiêu đề.
  - Loại nội dung.
  - Ngày đăng.
  - Mô tả ngắn.
  - Ảnh đại diện nếu có.
  - Link đến trang chi tiết.
- Hỗ trợ phân trang.

### 3.3. Điều hướng sang microsite

- Menu VAGO 2026 mở URL hội nghị.
- Menu Tạp chí VAGO mở `https://vjog.vn/journal`.
- Nên mở cùng tab hoặc tab mới theo cấu hình quản trị.
- URL cần quản lý trong phần cài đặt, không hard-code trực tiếp trong giao diện.

### 3.4. Hệ thống quản trị nội dung

Admin cần có khả năng:

- Quản lý menu.
- Quản lý trang tĩnh.
- Quản lý tin tức, thông báo, hoạt động.
- Quản lý đào tạo.
- Quản lý album và hình ảnh.
- Quản lý nội dung đa ngôn ngữ.
- Quản lý form đăng ký hội viên.
- Quản lý form liên hệ.
- Quản lý banner trang chủ.
- Quản lý thông tin liên hệ.
- Cấu hình link VAGO 2026 và Tạp chí VAGO.
- Cấu hình SEO cơ bản.
- Ẩn/hiện và sắp xếp nội dung.

---

## 4. Yêu cầu từng trang

## 4.1. Trang chủ

### Khối 1: Banner/slider

- Hiển thị slider hình ảnh chạy tự động liên tục.
- Cho phép admin:
  - Thêm/xóa/sửa slide.
  - Cập nhật ảnh desktop và mobile.
  - Nhập tiêu đề, mô tả ngắn.
  - Gắn đường dẫn khi click.
  - Sắp xếp thứ tự.
  - Bật/tắt slide.
- Có nút chuyển slide và chấm phân trang.
- Tự động chuyển slide nhưng phải cho phép người dùng dừng hoặc điều khiển thủ công.

### Khối 2: Tin tức nổi bật

Theo bố cục minh họa trong brief:

- Một nội dung nổi bật chính.
- Danh sách các nội dung nổi bật bên cạnh hoặc bên dưới.
- Mỗi item hiển thị:
  - Ảnh đại diện.
  - Tiêu đề.
  - Thời gian đăng.
  - Mô tả ngắn.
  - Link chi tiết.
- Admin có thể đánh dấu bài viết là “Nổi bật”.

### Khối 3: Thông báo của Hội

- Hiển thị danh sách thông báo mới.
- Mỗi thông báo gồm:
  - Tiêu đề.
  - Thời gian.
  - Mô tả ngắn.
  - Link chi tiết.
- Có nút “Xem thêm”.

### Khối 4: Hội nghị Sản Phụ khoa Quốc tế VAGO 2026

- Có ảnh đại diện/banner.
- Có tiêu đề và nội dung giới thiệu ngắn.
- Có nút chuyển sang website VAGO 2026.
- Nội dung và link quản lý được trong admin.

### Khối 5: Các nội dung bổ sung

Brief có ký hiệu “...” nên chưa xác định đầy đủ các section còn lại.

AI code cần:

- Thiết kế trang chủ theo cấu trúc module.
- Cho phép bổ sung section mới mà không phải sửa toàn bộ layout.
- Không tự tạo thêm nội dung nghiệp vụ chưa có trong brief.

---

## 4.2. Trang Giới thiệu chung

### Tiêu đề

**GIỚI THIỆU VỀ HỘI PHỤ SẢN VIỆT NAM (VAGO)**

### Nội dung giới thiệu

Website cần nhập và hiển thị nội dung giới thiệu Hội theo brief, gồm:

- VAGO là tổ chức xã hội – nghề nghiệp trong lĩnh vực sản – phụ khoa.
- Hội quy tụ các giáo sư, bác sĩ, nhà khoa học và chuyên gia trên toàn quốc.
- Sứ mệnh:
  - Thúc đẩy phát triển chuyên ngành sản – phụ khoa.
  - Nâng cao chất lượng chăm sóc sức khỏe bà mẹ và trẻ sơ sinh.
  - Kết nối cộng đồng chuyên môn.
  - Chia sẻ tri thức và ứng dụng tiến bộ y học.

### Khối Tầm nhìn – Sứ mệnh – Vai trò

Hiển thị 5 nhóm nội dung:

1. **Nâng cao chuyên môn và đào tạo liên tục**
2. **Thúc đẩy nghiên cứu khoa học**
3. **Xây dựng các hướng dẫn và tiêu chuẩn chuyên môn**
4. **Hợp tác quốc tế**
5. **Truyền thông và nâng cao nhận thức cộng đồng**

### Yêu cầu hiển thị

- Nội dung được quản lý từ CMS.
- Hỗ trợ trình soạn thảo rich text.
- Có thể chèn ảnh vào nội dung.
- Hỗ trợ heading, danh sách, liên kết, bảng và chú thích ảnh.
- Có bản tiếng Việt và tiếng Anh.

---

## 4.3. Trang Thư Chủ tịch

- Nội dung sẽ cập nhật sau.
- Chuẩn bị sẵn cấu trúc:
  - Tiêu đề.
  - Ảnh Chủ tịch.
  - Họ tên và chức danh.
  - Nội dung thư.
  - Chữ ký hoặc ảnh chữ ký nếu có.
- Quản lý từ CMS.
- Hỗ trợ song ngữ.

---

## 4.4. Trang Ban Chấp hành

- Nội dung sẽ cập nhật sau.
- Cần chuẩn bị module quản lý danh sách thành viên.

Mỗi thành viên có các trường:

- Họ tên.
- Chức danh trong Hội.
- Học hàm/học vị.
- Đơn vị công tác.
- Ảnh đại diện.
- Tiểu sử ngắn.
- Thứ tự hiển thị.
- Nhiệm kỳ.
- Trạng thái hiển thị.
- Nội dung tiếng Việt và tiếng Anh.

Trang frontend hiển thị dạng grid/card và hỗ trợ responsive.

---

## 4.5. Trang Đào tạo

- Nội dung chính thức cập nhật sau.
- Xây dựng sẵn cấu trúc danh sách các chương trình đào tạo.

Mỗi chương trình có thể gồm:

- Tên chương trình.
- Ảnh đại diện.
- Mô tả ngắn.
- Nội dung chi tiết.
- Thời gian.
- Địa điểm.
- Đơn vị tổ chức.
- Hình thức đào tạo.
- Link đăng ký.
- File tài liệu đính kèm.
- Trạng thái sắp diễn ra/đang diễn ra/đã kết thúc.
- Nội dung song ngữ.

---

## 4.6. Trang Thể lệ đăng ký hội viên

- Nội dung cập nhật sau.
- Tạo trang tĩnh quản lý bằng CMS.
- Hỗ trợ:
  - Rich text.
  - File đính kèm.
  - Nút chuyển sang form đăng ký hội viên.
  - Nội dung Việt/Anh.

---

## 4.7. Form đăng ký hội viên

Brief chỉ yêu cầu tạo form và ghi chú “cập nhật sau”, chưa cung cấp danh sách trường dữ liệu.

### Giai đoạn hiện tại

AI code cần tạo form có cấu trúc mở, cho phép bổ sung trường sau.

Có thể chuẩn bị các nhóm trường dự kiến, nhưng không kích hoạt khi chưa được xác nhận:

- Họ và tên.
- Ngày sinh.
- Giới tính.
- Học hàm/học vị.
- Chuyên môn.
- Đơn vị công tác.
- Chức vụ.
- Số điện thoại.
- Email.
- Địa chỉ.
- Tỉnh/thành.
- Loại hội viên.
- File hồ sơ đính kèm.
- Ghi chú.

### Chức năng cần có

- Validate dữ liệu phía client và server.
- Chống spam.
- Lưu đăng ký vào database.
- Gửi email thông báo cho quản trị viên.
- Gửi email xác nhận cho người đăng ký.
- Admin xem danh sách, lọc, tìm kiếm và xuất dữ liệu.
- Trạng thái xử lý:
  - Mới tiếp nhận.
  - Đang xét duyệt.
  - Đã duyệt.
  - Từ chối.
- Lưu lịch sử thay đổi trạng thái.

> Danh sách trường chính thức phải được xác nhận trước khi hoàn thiện.

---

## 4.8. Tạp chí VAGO

- Không xây dựng module tạp chí trong website này.
- Click menu chuyển sang:

```text
https://vjog.vn/journal
```

- Link có thể thay đổi trong admin.

---

## 4.9. Thư viện ảnh

### Trang danh sách album

Hiển thị dạng card, mỗi album gồm:

- Ảnh đại diện.
- Tên album.
- Ngày đăng hoặc thời gian sự kiện.
- Mô tả ngắn nếu có.
- Nút “Xem thêm”.

### Trang chi tiết album

- Hiển thị tên album.
- Mô tả.
- Thời gian.
- Danh sách ảnh.
- Lightbox khi click ảnh.
- Cho phép chuyển ảnh trước/sau.
- Lazy loading.
- Tối ưu ảnh thumbnail và ảnh gốc.

### Admin

- Tạo/sửa/xóa album.
- Upload nhiều ảnh.
- Chọn ảnh đại diện.
- Sắp xếp ảnh.
- Nhập alt text và chú thích.
- Bật/tắt album.
- Hỗ trợ song ngữ cho tên và mô tả album.

---

## 4.10. Tin tức – Thông báo

### Nhóm nội dung

- Thông báo.
- Hoạt động.

### Trang danh sách

Hiển thị dạng card giống hình minh họa trong brief:

- Ảnh đại diện.
- Tiêu đề.
- Ngày đăng.
- Mô tả ngắn.
- Nút “Xem bài viết”.
- Phân trang.
- Có thể lọc theo nhóm nội dung.

### Trang chi tiết

- Tiêu đề.
- Ngày đăng.
- Ảnh đại diện.
- Nội dung rich text.
- File đính kèm nếu có.
- Chia sẻ mạng xã hội.
- Tin liên quan.
- Breadcrumb.
- SEO metadata.

### Admin

- Tạo/sửa/xóa bài.
- Chọn nhóm bài viết.
- Đánh dấu nổi bật.
- Hẹn giờ đăng.
- Lưu nháp/xuất bản.
- Quản lý slug.
- Quản lý ảnh đại diện.
- Quản lý file đính kèm.
- Nội dung Việt/Anh.

---

## 4.11. Trang Liên hệ

### Form liên hệ

Theo hình minh họa trong brief, form gồm:

- Họ tên.
- Số điện thoại.
- Địa chỉ.
- Email.
- Chủ đề.
- Nội dung.
- Nút gửi.

### Yêu cầu

- Validate dữ liệu.
- Chống spam.
- Hiển thị thông báo gửi thành công/thất bại.
- Lưu nội dung liên hệ vào database.
- Gửi email cho quản trị viên.
- Admin xem và cập nhật trạng thái xử lý.

### Thông tin văn phòng

Hiển thị đúng nội dung trong brief:

**VĂN PHÒNG TRUNG ƯƠNG HỘI**

- Tầng 7, nhà G.
- Bệnh viện Phụ sản Trung ương.
- Số 1 Phố Triệu Quốc Đạt, Phường Cửa Nam, TP. Hà Nội.
- Email: `vago.vn@gmail.com`
- Điện thoại: `024.9346743`

Nên bổ sung:

- Bản đồ Google Maps.
- Nút gọi điện.
- Nút gửi email.
- Thời gian làm việc nếu được cung cấp sau.

---

## 5. Cấu trúc dữ liệu đề xuất

## 5.1. Bảng nội dung trang tĩnh

```text
pages
- id
- parent_id
- type
- title_vi
- title_en
- slug_vi
- slug_en
- excerpt_vi
- excerpt_en
- content_vi
- content_en
- featured_image
- status
- sort_order
- seo_title_vi
- seo_title_en
- seo_description_vi
- seo_description_en
- created_at
- updated_at
```

## 5.2. Bảng bài viết

```text
posts
- id
- category_id
- title_vi
- title_en
- slug_vi
- slug_en
- excerpt_vi
- excerpt_en
- content_vi
- content_en
- featured_image
- published_at
- is_featured
- status
- author_id
- created_at
- updated_at
```

## 5.3. Danh mục bài viết

```text
categories
- id
- name_vi
- name_en
- slug_vi
- slug_en
- type
- sort_order
- status
```

## 5.4. Album và hình ảnh

```text
albums
album_images
```

Các trường cần bao gồm nội dung đa ngôn ngữ, ảnh đại diện, thứ tự và trạng thái.

## 5.5. Hội viên

```text
member_applications
member_application_status_logs
```

## 5.6. Liên hệ

```text
contact_submissions
```

## 5.7. Banner

```text
banners
```

## 5.8. Cài đặt website

```text
settings
```

Lưu các thông tin:

- Logo.
- Favicon.
- Thông tin liên hệ.
- Link microsite VAGO 2026.
- Link Tạp chí VAGO.
- Mạng xã hội.
- Email nhận form.
- Cấu hình SEO mặc định.

---

## 6. Yêu cầu giao diện

### 6.1. Phong cách

- Trang trọng, chuyên nghiệp, phù hợp với tổ chức y khoa.
- Bố cục rõ ràng, dễ đọc.
- Không sử dụng quá nhiều hiệu ứng.
- Ưu tiên nội dung chuyên môn và khả năng truy cập nhanh.
- Hình ảnh trong brief chỉ thể hiện bố cục tham khảo, không phải bản thiết kế UI hoàn chỉnh.

### 6.2. Header

- Logo VAGO.
- Menu chính.
- Menu con dạng dropdown.
- Thanh tìm kiếm.
- Nút chuyển ngôn ngữ.
- Menu mobile dạng drawer hoặc off-canvas.
- Header có thể sticky khi cuộn.

### 6.3. Footer

- Logo.
- Giới thiệu ngắn.
- Menu nhanh.
- Thông tin văn phòng.
- Email và số điện thoại.
- Liên kết mạng xã hội.
- Bản quyền.
- Link chính sách bảo mật nếu có.

### 6.4. Responsive

Kiểm tra tối thiểu tại:

- Mobile: 375px.
- Tablet: 768px.
- Laptop: 1366px.
- Desktop lớn: 1920px.

---

## 7. Yêu cầu SEO

- URL thân thiện.
- Mỗi nội dung có:
  - SEO title.
  - Meta description.
  - Canonical URL.
  - Open Graph image.
- Tự động tạo sitemap XML.
- Có robots.txt.
- Breadcrumb.
- Schema đề xuất:
  - Organization.
  - Article/NewsArticle.
  - BreadcrumbList.
  - ContactPage.
- Hỗ trợ SEO theo từng ngôn ngữ.
- Thêm `hreflang` cho Việt/Anh.
- Alt text cho ảnh.
- Redirect 301 khi thay đổi slug.

---

## 8. Hiệu năng và tối ưu ảnh

- Dùng định dạng WebP/AVIF khi phù hợp.
- Tạo thumbnail theo nhiều kích thước.
- Lazy load ảnh.
- Không tải ảnh gốc dung lượng lớn ở trang danh sách.
- Cache dữ liệu và trang nếu stack cho phép.
- Minify CSS/JS.
- Tối ưu Core Web Vitals.
- Slider không được làm ảnh hưởng lớn đến LCP.
- Có placeholder khi ảnh chưa tải xong.

---

## 9. Bảo mật

- Validate và sanitize toàn bộ dữ liệu nhập.
- Chống CSRF.
- Chống XSS.
- Giới hạn loại và dung lượng file upload.
- Đổi tên file upload để tránh trùng và lỗi ký tự.
- Chống spam form bằng CAPTCHA hoặc honeypot.
- Rate limit form liên hệ và đăng ký hội viên.
- Phân quyền admin.
- Ghi log các hành động quan trọng.
- Không public dữ liệu cá nhân của người đăng ký hội viên.
- Có chính sách lưu trữ và bảo vệ dữ liệu cá nhân.

---

## 10. Phân quyền admin đề xuất

### Super Admin

- Toàn quyền hệ thống.

### Content Admin

- Quản lý trang, bài viết, album, banner.

### Membership Admin

- Quản lý đăng ký hội viên.

### Contact Admin

- Xem và xử lý form liên hệ.

### Translator

- Chỉ chỉnh sửa nội dung theo ngôn ngữ được phân quyền.

---

## 11. Tiêu chí nghiệm thu

### Chức năng chung

- Menu đúng cấu trúc brief.
- Chuyển đổi Việt/Anh hoạt động.
- Tìm kiếm trả về kết quả chính xác.
- Link VAGO 2026 và Tạp chí chuyển hướng đúng.
- Website responsive trên mobile/tablet/desktop.

### Trang chủ

- Slider tự chạy và điều khiển được.
- Tin nổi bật và thông báo hiển thị từ CMS.
- Khối VAGO 2026 chuyển đúng microsite.

### Nội dung

- Admin tạo/sửa/xóa nội dung.
- Có nháp và xuất bản.
- Nội dung tiếng Việt và tiếng Anh hoạt động độc lập.
- Ảnh và file tải lên đúng quy định.

### Thư viện

- Tạo album và upload nhiều ảnh.
- Lightbox hoạt động.
- Ảnh được tối ưu.

### Form

- Form liên hệ gửi và lưu dữ liệu thành công.
- Form hội viên lưu được hồ sơ.
- Email thông báo hoạt động.
- Có validation và chống spam.
- Admin lọc và xuất dữ liệu đăng ký.

### SEO và hiệu năng

- Sitemap và robots hoạt động.
- Metadata thay đổi theo từng trang.
- Không có lỗi nghiêm trọng trên Lighthouse.
- Không có link nội bộ bị hỏng.

---

## 12. Các nội dung chưa đủ dữ liệu, cần xác nhận

1. URL đầy đủ của microsite VAGO 2026.
2. Bộ nhận diện thương hiệu:
   - Logo chuẩn.
   - Màu sắc.
   - Font chữ.
   - Quy chuẩn hình ảnh.
3. Nội dung tiếng Anh.
4. Nội dung Thư Chủ tịch.
5. Danh sách Ban Chấp hành.
6. Nội dung trang Đào tạo.
7. Thể lệ đăng ký hội viên.
8. Danh sách trường chính thức của form hội viên.
9. Quy trình duyệt hội viên.
10. Email nhận form và cấu hình SMTP.
11. Danh sách mạng xã hội.
12. Danh sách section đầy đủ của trang chủ.
13. Yêu cầu import dữ liệu từ website cũ.
14. Website mới dùng CMS/framework nào.
15. Quyền quản trị và số lượng tài khoản admin.
16. Chính sách dữ liệu cá nhân.
17. Có yêu cầu thanh toán phí hội viên hay không.
18. Có cần đồng bộ dữ liệu với hệ thống khác hay không.

---

## 13. Thứ tự triển khai đề xuất

### Giai đoạn 1: Khung hệ thống

- Setup project.
- Database.
- Authentication admin.
- CMS đa ngôn ngữ.
- Menu, setting, SEO.
- Layout header/footer.

### Giai đoạn 2: Nội dung chính

- Trang chủ.
- Giới thiệu.
- Tin tức – Thông báo.
- Thư viện ảnh.
- Liên hệ.
- Redirect VAGO 2026 và Tạp chí.

### Giai đoạn 3: Hội viên và đào tạo

- Form hội viên.
- Quy trình xử lý hồ sơ.
- Module đào tạo.
- Email thông báo.
- Export dữ liệu.

### Giai đoạn 4: Hoàn thiện

- Nhập nội dung.
- Kiểm thử responsive.
- Kiểm thử bảo mật.
- SEO.
- Tối ưu hiệu năng.
- Deploy và nghiệm thu.

---

## 14. Prompt ngắn để giao cho AI code

```text
Hãy xây dựng website Hội Sản Phụ khoa Việt Nam (VAGO) theo file yêu cầu này.

Ưu tiên:
1. Kiến trúc module, dễ mở rộng.
2. CMS quản trị nội dung song ngữ Việt – Anh.
3. Responsive.
4. SEO-friendly.
5. Bảo mật form và dữ liệu cá nhân.
6. Tối ưu hiệu năng và hình ảnh.

Không tự tạo thêm nghiệp vụ chưa được xác nhận. Với các mục ghi “cập nhật sau”, hãy tạo sẵn module, schema và giao diện placeholder để có thể bổ sung dữ liệu sau.

Trước khi code, hãy:
- Đọc toàn bộ yêu cầu.
- Đề xuất sitemap.
- Đề xuất database schema.
- Liệt kê các API/module.
- Chia task theo phase.
- Chỉ bắt đầu code sau khi cấu trúc được xác nhận.
```
