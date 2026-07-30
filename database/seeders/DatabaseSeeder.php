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
            ['key' => 'vago2026_url', 'value' => 'https://vago2026.websitehoinghi', 'group' => 'links'],
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
                'content_vi' => '<p>Nội dung thể lệ đăng ký hội viên đang được cập nhật.</p><p><a href="/hoi-vien/dang-ky">Đăng ký hội viên</a></p>',
                'content_en' => '<p>Membership regulations content is being updated.</p><p><a href="/hoi-vien/dang-ky">Register as a member</a></p>',
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
        $members = [
            ['name_vi' => 'PGS.TS. Nguyễn Văn A', 'name_en' => 'Assoc. Prof. Nguyen Van A', 'position_vi' => 'Chủ tịch Hội', 'position_en' => 'President', 'sort_order' => 1],
            ['name_vi' => 'PGS.TS. Trần Thị B', 'name_en' => 'Assoc. Prof. Tran Thi B', 'position_vi' => 'Tổng Thư ký', 'position_en' => 'Secretary General', 'sort_order' => 2],
        ];

        foreach ($members as $member) {
            BoardMember::query()->updateOrCreate(
                ['name_vi' => $member['name_vi']],
                array_merge($member, [
                    'title_vi' => 'PGS.TS',
                    'title_en' => 'Assoc. Prof.',
                    'organization_vi' => 'Bệnh viện Phụ sản Trung ương',
                    'organization_en' => 'National Hospital of Obstetrics and Gynecology',
                    'bio_vi' => 'Tiểu sử đang được cập nhật.',
                    'bio_en' => 'Biography is being updated.',
                    'term' => '2025–2030',
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
