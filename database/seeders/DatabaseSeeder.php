<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\BoardMember;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@vago.vn'],
            [
                'name' => 'Admin VAGO',
                'password' => Hash::make('password'),
                'role' => 'super_admin',
            ]
        );

        $this->seedSettings();
        $this->seedCategories();
        $this->seedPages();
        $this->seedPosts($admin);
        $this->seedBoardMembers();
        $this->seedBanner();
    }

    private function seedSettings(): void
    {
        $settings = [
            ['key' => 'site_name_vi', 'value' => 'Hội Phụ sản Việt Nam (VAGO)', 'group' => 'general'],
            ['key' => 'site_name_en', 'value' => 'Vietnam Association of Gynecology and Obstetrics (VAGO)', 'group' => 'general'],
            ['key' => 'contact_address_vi', 'value' => "Tầng 7, nhà G, Bệnh viện Phụ sản Trung ương\nSố 1 Phố Triệu Quốc Đạt, Phường Cửa Nam, TP. Hà Nội", 'group' => 'contact'],
            ['key' => 'contact_address_en', 'value' => "7th Floor, Building G, National Hospital of Obstetrics and Gynecology\n1 Trieu Quoc Dat Street, Cua Nam Ward, Hanoi", 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'vago.vn@gmail.com', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '024.9346743', 'group' => 'contact'],
            ['key' => 'vago2026_url', 'value' => 'https://vago2026.websitehoinghi.com/vi', 'group' => 'links'],
            ['key' => 'vago2026_open_new_tab', 'value' => '1', 'group' => 'links', 'type' => 'boolean'],
            ['key' => 'journal_url', 'value' => 'https://vjog.vn/journal', 'group' => 'links'],
            ['key' => 'journal_open_new_tab', 'value' => '1', 'group' => 'links', 'type' => 'boolean'],
            ['key' => 'notification_email', 'value' => 'vago.vn@gmail.com', 'group' => 'contact'],
            ['key' => 'default_seo_title_vi', 'value' => 'VAGO — Hội Phụ sản Việt Nam', 'group' => 'seo'],
            ['key' => 'default_seo_title_en', 'value' => 'VAGO — Vietnam Association of Gynecology and Obstetrics', 'group' => 'seo'],
            ['key' => 'default_seo_description_vi', 'value' => 'Hội Phụ sản Việt Nam (VAGO) — tổ chức xã hội nghề nghiệp kết nối chuyên gia sản phụ khoa trên toàn quốc.', 'group' => 'seo'],
            ['key' => 'default_seo_description_en', 'value' => 'Vietnam Association of Gynecology and Obstetrics (VAGO) — connecting OB/GYN professionals nationwide.', 'group' => 'seo'],
        ];

        foreach ($settings as $row) {
            Setting::query()->updateOrCreate(
                ['key' => $row['key']],
                [
                    'value' => $row['value'],
                    'group' => $row['group'],
                    'type' => $row['type'] ?? 'string',
                ]
            );
        }
    }

    private function seedCategories(): void
    {
        Category::query()->updateOrCreate(
            ['slug_vi' => 'thong-bao'],
            [
                'name_vi' => 'Thông báo',
                'name_en' => 'Announcements',
                'slug_en' => 'announcements',
                'type' => 'post',
                'sort_order' => 1,
                'status' => 'published',
            ]
        );

        Category::query()->updateOrCreate(
            ['slug_vi' => 'hoat-dong'],
            [
                'name_vi' => 'Hoạt động',
                'name_en' => 'Activities',
                'slug_en' => 'activities',
                'type' => 'post',
                'sort_order' => 2,
                'status' => 'published',
            ]
        );
    }

    private function seedPages(): void
    {
        Page::query()->updateOrCreate(
            ['slug_vi' => 'gioi-thieu-chung'],
            [
                'type' => 'about',
                'title_vi' => 'Giới thiệu về Hội Phụ sản Việt Nam (VAGO)',
                'title_en' => 'About Vietnam Association of Gynecology and Obstetrics (VAGO)',
                'slug_en' => 'about-vago',
                'excerpt_vi' => 'VAGO là tổ chức xã hội – nghề nghiệp trong lĩnh vực sản – phụ khoa.',
                'excerpt_en' => 'VAGO is a professional social organization in obstetrics and gynecology.',
                'content_vi' => <<<'HTML'
<p>Hội Phụ sản Việt Nam (Vietnam Association of Gynecology and Obstetrics – VAGO) là tổ chức xã hội – nghề nghiệp quy tụ đội ngũ các giáo sư, bác sĩ, nhà khoa học và chuyên gia hoạt động trong lĩnh vực sản – phụ khoa trên toàn quốc.</p>
<p>Hội được thành lập với sứ mệnh thúc đẩy sự phát triển của chuyên ngành sản-phụ khoa, nâng cao chất lượng chăm sóc sức khỏe bà mẹ và trẻ sơ sinh, đồng thời kết nối cộng đồng chuyên môn để chia sẻ tri thức và ứng dụng những tiến bộ y học hiện đại.</p>
<h2>Tầm nhìn — Sứ mệnh — Vai trò</h2>
<ol>
<li><strong>Nâng cao chuyên môn và đào tạo liên tục</strong></li>
<li><strong>Thúc đẩy nghiên cứu khoa học</strong></li>
<li><strong>Xây dựng các hướng dẫn và tiêu chuẩn chuyên môn</strong></li>
<li><strong>Hợp tác quốc tế</strong></li>
<li><strong>Truyền thông và nâng cao nhận thức cộng đồng</strong></li>
</ol>
HTML,
                'content_en' => <<<'HTML'
<p>The Vietnam Association of Gynecology and Obstetrics (VAGO) is a professional social organization that brings together professors, physicians, scientists and specialists in obstetrics and gynecology nationwide.</p>
<p>VAGO promotes the development of the specialty, improves maternal and newborn care, and connects the professional community to share knowledge and apply modern medical advances.</p>
HTML,
                'status' => 'published',
                'published_at' => now(),
                'sort_order' => 1,
            ]
        );

        Page::query()->updateOrCreate(
            ['slug_vi' => 'thu-chu-tich'],
            [
                'type' => 'about',
                'title_vi' => 'Thư Chủ tịch',
                'title_en' => 'Letter from the President',
                'slug_en' => 'president-letter',
                'excerpt_vi' => 'Nội dung thư Chủ tịch đang được cập nhật.',
                'excerpt_en' => 'The President’s letter content is being updated.',
                'content_vi' => '<p>Nội dung đang được cập nhật.</p>',
                'content_en' => '<p>Content is being updated.</p>',
                'status' => 'published',
                'published_at' => now(),
                'sort_order' => 2,
            ]
        );

        Page::query()->updateOrCreate(
            ['slug_vi' => 'the-le-hoi-vien'],
            [
                'type' => 'member',
                'title_vi' => 'Thể lệ đăng ký hội viên',
                'title_en' => 'Membership regulations',
                'slug_en' => 'membership-regulations',
                'excerpt_vi' => 'Điều lệ Hội Phụ sản Việt Nam — tài liệu tham khảo khi đăng ký hội viên.',
                'excerpt_en' => 'VAGO Charter — reference document for membership registration.',
                'content_vi' => '<p>Quý bác sĩ/hội viên vui lòng xem <strong>Điều lệ Hội Phụ sản Việt Nam</strong> bên dưới trước khi đăng ký hội viên.</p>',
                'content_en' => '<p>Please review the <strong>VAGO Charter</strong> below before submitting a membership application.</p>',
                'status' => 'published',
                'published_at' => now(),
                'sort_order' => 1,
            ]
        );
    }

    private function seedPosts(User $admin): void
    {
        $thongBao = Category::query()->where('slug_vi', 'thong-bao')->first();
        $hoatDong = Category::query()->where('slug_vi', 'hoat-dong')->first();

        Post::query()->updateOrCreate(
            ['slug_vi' => 'thong-bao-hoat-dong-hoi'],
            [
                'category_id' => $thongBao?->id,
                'author_id' => $admin->id,
                'title_vi' => 'Thông báo hoạt động của Hội',
                'title_en' => 'Association activity announcement',
                'slug_en' => 'association-activity-announcement',
                'excerpt_vi' => 'Thông báo các hoạt động chuyên môn sắp tới của Hội Phụ sản Việt Nam.',
                'excerpt_en' => 'Announcement of upcoming professional activities of VAGO.',
                'content_vi' => '<p>Kính gửi Quý hội viên,</p><p>Hội Phụ sản Việt Nam xin thông báo các hoạt động chuyên môn sắp tới. Chi tiết sẽ được cập nhật trên website.</p>',
                'content_en' => '<p>Dear members,</p><p>VAGO announces upcoming professional activities. Details will be updated on the website.</p>',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ]
        );

        Post::query()->updateOrCreate(
            ['slug_vi' => 'hoat-dong-dao-tao-cme'],
            [
                'category_id' => $hoatDong?->id,
                'author_id' => $admin->id,
                'title_vi' => 'Hoạt động đào tạo CME',
                'title_en' => 'CME training activities',
                'slug_en' => 'cme-training-activities',
                'excerpt_vi' => 'Tổng hợp các khóa đào tạo liên tục dành cho hội viên.',
                'excerpt_en' => 'Overview of continuing medical education courses for members.',
                'content_vi' => '<p>Nội dung hoạt động đào tạo đang được cập nhật.</p>',
                'content_en' => '<p>Training activity content is being updated.</p>',
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now()->subDay(),
            ]
        );
    }

    private function seedBoardMembers(): void
    {
        // Xóa bản ghi mẫu cũ (nếu còn).
        BoardMember::query()
            ->whereIn('name_vi', [
                'PGS.TS. Nguyễn Văn A',
                'PGS.TS. Trần Thị B',
            ])
            ->delete();

        $members = [
            ['name_vi' => 'GS.TS. Nguyễn Viết Tiến', 'name_en' => 'Prof. Dr. Nguyen Viet Tien', 'title_vi' => 'GS.TS.', 'title_en' => 'Prof. Dr.', 'position_vi' => 'Chủ tịch', 'position_en' => 'President'],
            ['name_vi' => 'GS.TS. Nguyễn Duy Ánh', 'name_en' => 'Prof. Dr. Nguyen Duy Anh', 'title_vi' => 'GS.TS.', 'title_en' => 'Prof. Dr.', 'position_vi' => 'Phó Chủ tịch thường trực', 'position_en' => 'Standing Vice President'],
            ['name_vi' => 'GS.TS. Trần Danh Cường', 'name_en' => 'Prof. Dr. Tran Danh Cuong', 'title_vi' => 'GS.TS.', 'title_en' => 'Prof. Dr.', 'position_vi' => 'Phó Chủ tịch', 'position_en' => 'Vice President'],
            ['name_vi' => 'GS. Nguyễn Thị Ngọc Phượng', 'name_en' => 'Prof. Nguyen Thi Ngoc Phuong', 'title_vi' => 'GS.', 'title_en' => 'Prof.', 'position_vi' => 'Phó Chủ tịch', 'position_en' => 'Vice President'],
            ['name_vi' => 'PGS.TS. Vũ Bá Quyết', 'name_en' => 'Assoc. Prof. Dr. Vu Ba Quyet', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Phó Chủ tịch', 'position_en' => 'Vice President'],
            ['name_vi' => 'GS.TS. Cao Ngọc Thành', 'name_en' => 'Prof. Dr. Cao Ngoc Thanh', 'title_vi' => 'GS.TS.', 'title_en' => 'Prof. Dr.', 'position_vi' => 'Phó Chủ tịch', 'position_en' => 'Vice President'],
            ['name_vi' => 'GS.TS. Nguyễn Vũ Quốc Huy', 'name_en' => 'Prof. Dr. Nguyen Vu Quoc Huy', 'title_vi' => 'GS.TS.', 'title_en' => 'Prof. Dr.', 'position_vi' => 'Phó Chủ tịch; Phó Tổng Biên tập Tạp chí Sản Phụ khoa', 'position_en' => 'Vice President; Deputy Editor-in-Chief, Journal of Obstetrics and Gynecology'],
            ['name_vi' => 'TS. Lê Quang Thanh', 'name_en' => 'Dr. Le Quang Thanh', 'title_vi' => 'TS.', 'title_en' => 'Dr.', 'position_vi' => 'Phó Chủ tịch', 'position_en' => 'Vice President'],
            ['name_vi' => 'PGS.TS. Hoàng Thị Diễm Tuyết', 'name_en' => 'Assoc. Prof. Dr. Hoang Thi Diem Tuyet', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Phó Chủ tịch', 'position_en' => 'Vice President'],
            ['name_vi' => 'PGS.TS. Vũ Văn Tâm', 'name_en' => 'Assoc. Prof. Dr. Vu Van Tam', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Phó Chủ tịch', 'position_en' => 'Vice President'],
            ['name_vi' => 'PGS.TS. Lưu Thị Hồng', 'name_en' => 'Assoc. Prof. Dr. Luu Thi Hong', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Tổng Thư ký', 'position_en' => 'Secretary General'],
            ['name_vi' => 'GS.TS. Trần Thị Phương Mai', 'name_en' => 'Prof. Dr. Tran Thi Phuong Mai', 'title_vi' => 'GS.TS.', 'title_en' => 'Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'GS.TS. Trần Thị Lợi', 'name_en' => 'Prof. Dr. Tran Thi Loi', 'title_vi' => 'GS.TS.', 'title_en' => 'Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'TS. Vũ Thị Nhung', 'name_en' => 'Dr. Vu Thi Nhung', 'title_vi' => 'TS.', 'title_en' => 'Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'BSCKII. Nguyễn Hữu Dự', 'name_en' => 'Specialist Level II Nguyen Huu Du', 'title_vi' => 'BSCKII.', 'title_en' => 'Specialist Level II', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'TS. Nguyễn Xuân Huy', 'name_en' => 'Dr. Nguyen Xuan Huy', 'title_vi' => 'TS.', 'title_en' => 'Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'GS.TS. Vương Tiến Hòa', 'name_en' => 'Prof. Dr. Vuong Tien Hoa', 'title_vi' => 'GS.TS.', 'title_en' => 'Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'TS. Huỳnh Thị Kim Chi', 'name_en' => 'Dr. Huynh Thi Kim Chi', 'title_vi' => 'TS.', 'title_en' => 'Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'PGS.TS. Lê Hoài Chương', 'name_en' => 'Assoc. Prof. Dr. Le Hoai Chuong', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'PGS.TS. Vũ Văn Du', 'name_en' => 'Assoc. Prof. Dr. Vu Van Du', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'PGS.TS. Phạm Bá Nha', 'name_en' => 'Assoc. Prof. Dr. Pham Ba Nha', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'PGS.TS. Nguyễn Ngọc Minh', 'name_en' => 'Assoc. Prof. Dr. Nguyen Ngoc Minh', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'BS. Đỗ Thị Kim Ngọc', 'name_en' => 'MD. Do Thi Kim Ngoc', 'title_vi' => 'BS.', 'title_en' => 'MD.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'PGS.TS. Lê Hoàng', 'name_en' => 'Assoc. Prof. Dr. Le Hoang', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'ThS. Hồ Mạnh Tường', 'name_en' => 'MSc. Ho Manh Tuong', 'title_vi' => 'ThS.', 'title_en' => 'MSc.', 'position_vi' => 'Ủy viên — phụ trách VP miền Nam', 'position_en' => 'Member — Southern Office'],
            ['name_vi' => 'TS. Trần Đình Vinh', 'name_en' => 'Dr. Tran Dinh Vinh', 'title_vi' => 'TS.', 'title_en' => 'Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'PGS.TS. Lê Hồng Cẩm', 'name_en' => 'Assoc. Prof. Dr. Le Hong Cam', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'PGS.TS. Lê Minh Tâm', 'name_en' => 'Assoc. Prof. Dr. Le Minh Tam', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'ThS. Đinh Anh Tuấn', 'name_en' => 'MSc. Dinh Anh Tuan', 'title_vi' => 'ThS.', 'title_en' => 'MSc.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'PGS.TS. Huỳnh Nguyễn Khánh Trang', 'name_en' => 'Assoc. Prof. Dr. Huynh Nguyen Khanh Trang', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'BSCKII. Trần Ngọc Hải', 'name_en' => 'Specialist Level II Tran Ngoc Hai', 'title_vi' => 'BSCKII.', 'title_en' => 'Specialist Level II', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'PGS.TS. Vương Thị Ngọc Lan', 'name_en' => 'Assoc. Prof. Dr. Vuong Thi Ngoc Lan', 'title_vi' => 'PGS.TS.', 'title_en' => 'Assoc. Prof. Dr.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'BSCKII. Bùi Minh Cường', 'name_en' => 'Specialist Level II Bui Minh Cuong', 'title_vi' => 'BSCKII.', 'title_en' => 'Specialist Level II', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'ThS. Hà Tố Nguyên', 'name_en' => 'MSc. Ha To Nguyen', 'title_vi' => 'ThS.', 'title_en' => 'MSc.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'BSCKII. Phạm Thanh Hải', 'name_en' => 'Specialist Level II Pham Thanh Hai', 'title_vi' => 'BSCKII.', 'title_en' => 'Specialist Level II', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'ThS. Nguyễn Việt Quang', 'name_en' => 'MSc. Nguyen Viet Quang', 'title_vi' => 'ThS.', 'title_en' => 'MSc.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'BS. Dương Thị Hải Ngọc', 'name_en' => 'MD. Duong Thi Hai Ngoc', 'title_vi' => 'BS.', 'title_en' => 'MD.', 'position_vi' => 'Ủy viên', 'position_en' => 'Member'],
            ['name_vi' => 'TS. Phạm Phương Lan', 'name_en' => 'Dr. Pham Phuong Lan', 'title_vi' => 'TS.', 'title_en' => 'Dr.', 'position_vi' => 'Thủ quỹ', 'position_en' => 'Treasurer'],
            ['name_vi' => 'Nguyễn Văn Hùng', 'name_en' => 'Nguyen Van Hung', 'title_vi' => null, 'title_en' => null, 'position_vi' => 'Kế toán trưởng', 'position_en' => 'Chief Accountant'],
        ];

        foreach ($members as $index => $member) {
            BoardMember::query()->updateOrCreate(
                ['name_vi' => $member['name_vi']],
                array_merge($member, [
                    'sort_order' => $index + 1,
                    'term' => '2021–2026',
                    'is_active' => true,
                ])
            );
        }
    }

    private function seedBanner(): void
    {
        if (Banner::query()->exists()) {
            return;
        }

        Banner::query()->create([
            'title_vi' => 'Hội Phụ sản Việt Nam',
            'title_en' => 'Vietnam Association of Gynecology and Obstetrics',
            'description_vi' => 'Kết nối chuyên môn, nâng cao chăm sóc sức khỏe bà mẹ và trẻ sơ sinh',
            'description_en' => 'Connecting professionals to improve maternal and newborn care',
            'image_desktop' => 'images/hero-banner.jpg',
            'image_mobile' => 'images/hero-banner.jpg',
            'link_url' => '/gioi-thieu/gioi-thieu-chung',
            'open_in_new_tab' => false,
            'sort_order' => 1,
            'is_active' => true,
        ]);
    }
}
