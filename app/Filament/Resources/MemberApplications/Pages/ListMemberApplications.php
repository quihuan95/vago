<?php

namespace App\Filament\Resources\MemberApplications\Pages;

use App\Filament\Resources\MemberApplications\MemberApplicationResource;
use App\Models\MemberApplication;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ListMemberApplications extends ListRecords
{
    protected static string $resource = MemberApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('export')
                ->label('Xuất CSV')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn () => $this->exportCsv()),
        ];
    }

    protected function exportCsv(): StreamedResponse
    {
        $filename = 'member-applications-'.now()->format('Y-m-d-His').'.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, [
                'ID', 'Họ tên', 'Ngày sinh', 'Giới tính', 'Học hàm/học vị', 'Chuyên môn',
                'Đơn vị', 'Chức vụ', 'Điện thoại', 'Email', 'Địa chỉ', 'Tỉnh/TP',
                'Loại HV', 'Trạng thái', 'Ghi chú', 'Ngày gửi',
            ]);

            MemberApplication::query()->orderByDesc('id')->chunk(200, function ($rows) use ($handle) {
                foreach ($rows as $row) {
                    fputcsv($handle, [
                        $row->id,
                        $row->full_name,
                        optional($row->date_of_birth)->format('Y-m-d'),
                        $row->gender,
                        $row->academic_title,
                        $row->specialty,
                        $row->organization,
                        $row->job_title,
                        $row->phone,
                        $row->email,
                        $row->address,
                        $row->province,
                        $row->member_type,
                        $row->status,
                        $row->notes,
                        optional($row->created_at)->format('Y-m-d H:i'),
                    ]);
                }
            });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
