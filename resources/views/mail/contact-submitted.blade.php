<x-mail::message>
# Liên hệ mới từ website VAGO

**Họ và tên:** {{ $submission->full_name }}

**Email:** {{ $submission->email }}

@if ($submission->phone)
**Điện thoại:** {{ $submission->phone }}
@endif

@if ($submission->address)
**Địa chỉ:** {{ $submission->address }}
@endif

@if ($submission->subject)
**Chủ đề:** {{ $submission->subject }}
@endif

**Nội dung:**

{{ $submission->message }}

---

Gửi lúc: {{ $submission->created_at?->format('d/m/Y H:i') }}
</x-mail::message>
