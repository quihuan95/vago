<x-mail::message>
# Đăng ký hội viên mới — Hội Phụ sản Việt Nam

**Họ và tên:** {{ $application->full_name }}

@if ($application->date_of_birth)
**Ngày sinh:** {{ $application->date_of_birth->format('d/m/Y') }}
@endif

@if ($application->gender)
**Giới tính:** {{ $application->gender }}
@endif

@if ($application->academic_title)
**Học hàm/học vị:** {{ $application->academic_title }}
@endif

@if ($application->specialty)
**Chuyên môn:** {{ $application->specialty }}
@endif

@if ($application->organization)
**Đơn vị công tác:** {{ $application->organization }}
@endif

@if ($application->job_title)
**Chức vụ:** {{ $application->job_title }}
@endif

**Điện thoại:** {{ $application->phone ?: '—' }}

**Email:** {{ $application->email }}

@if ($application->address)
**Địa chỉ:** {{ $application->address }}
@endif

@if ($application->province)
**Tỉnh/Thành phố:** {{ $application->province }}
@endif

@if ($application->member_type)
**Loại hội viên:** {{ $application->member_type }}
@endif

@if ($application->notes)
**Ghi chú:**

{{ $application->notes }}
@endif

---

Gửi lúc: {{ $application->created_at?->format('d/m/Y H:i') }}
</x-mail::message>
