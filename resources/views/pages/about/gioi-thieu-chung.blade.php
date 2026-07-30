@extends('layouts.app')

@section('title', ($page?->t('seo_title') ?: $page?->t('title')) ?: 'Giới thiệu về Hội Phụ sản Việt Nam (VAGO)')
@section('description', $page?->t('seo_description') ?: $page?->t('excerpt') ?: 'VAGO là tổ chức xã hội – nghề nghiệp trong lĩnh vực sản – phụ khoa, quy tụ các giáo sư, bác sĩ, nhà khoa học và chuyên gia trên toàn quốc.')

@section('content')
    @include('partials.page-hero', [
        'title' => $page?->t('title') ?: __('site.nav_about_general'),
        'subtitle' => $page?->t('excerpt'),
    ])

    @include('partials.breadcrumb', ['items' => [
        ['label' => __('site.nav_about'), 'url' => route('about.gioi-thieu-chung')],
        ['label' => __('site.nav_about_general')],
    ]])

    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        @if ($page && $page->t('content'))
            <div class="rich-content max-w-3xl">
                {!! $page->t('content') !!}
            </div>
        @else
            <div class="max-w-3xl">
                <p class="text-lg leading-relaxed text-muted">
                    Hội Phụ sản Việt Nam (Vietnam Association of Gynecology and Obstetrics – VAGO) là tổ chức xã hội – nghề nghiệp
                    quy tụ đội ngũ các giáo sư, bác sĩ, nhà khoa học và chuyên gia hoạt động trong lĩnh vực sản – phụ khoa trên toàn quốc.
                </p>
                <p class="mt-6 text-lg leading-relaxed text-muted">
                    Hội được thành lập với sứ mệnh thúc đẩy sự phát triển của chuyên ngành sản – phụ khoa, nâng cao chất lượng chăm sóc
                    sức khỏe bà mẹ và trẻ sơ sinh, đồng thời kết nối cộng đồng chuyên môn để chia sẻ tri thức và ứng dụng những tiến bộ
                    y học hiện đại.
                </p>
            </div>
        @endif

        <div class="mt-16">
            <h2 class="font-display text-3xl font-semibold text-vago-deep sm:text-4xl">{{ __('site.about_vision_mission') }}</h2>
            <div class="mt-4 h-1 w-24 bg-accent-warm"></div>

            <div class="mt-10 grid gap-8 md:grid-cols-2 xl:grid-cols-3">
                @php
                    $pillars = [
                        ['01', 'Nâng cao chuyên môn và đào tạo liên tục', 'Tổ chức hội nghị khoa học quốc gia, hội thảo chuyên đề và khóa đào tạo CME cho các chuyên gia sản – phụ khoa.'],
                        ['02', 'Thúc đẩy nghiên cứu khoa học', 'Khuyến khích nghiên cứu lâm sàng, tổng quan và ứng dụng thực hành; hỗ trợ hội nhập quốc tế.'],
                        ['03', 'Xây dựng hướng dẫn và tiêu chuẩn chuyên môn', 'Xây dựng, phổ biến hướng dẫn lâm sàng nhằm thống nhất thực hành và bảo đảm an toàn người bệnh.'],
                        ['04', 'Hợp tác quốc tế', 'Duy trì quan hệ với tổ chức sản – phụ khoa quốc tế qua trao đổi chuyên gia và hợp tác nghiên cứu.'],
                        ['05', 'Truyền thông và nâng cao nhận thức cộng đồng', 'Lan tỏa kiến thức về sức khỏe sinh sản, tiền sản – hậu sản và phòng ngừa bệnh lý phụ khoa.'],
                    ];
                @endphp

                @foreach ($pillars as [$num, $title, $body])
                    <article class="border-t-2 border-vago/30 pt-6 {{ $loop->last ? 'md:col-span-2 xl:col-span-1' : '' }}">
                        <p class="font-display text-3xl font-semibold text-vago/40">{{ $num }}</p>
                        <h3 class="mt-3 font-display text-xl font-semibold text-vago-deep">{{ $title }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-muted">{{ $body }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
@endsection
