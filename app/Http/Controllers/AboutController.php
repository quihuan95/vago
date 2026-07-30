<?php

namespace App\Http\Controllers;

use App\Models\BoardMember;
use App\Models\Page;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function gioiThieuChung(): View
    {
        $page = Page::query()
            ->published()
            ->where(function ($query) {
                $query->where('type', 'gioi-thieu-chung')
                    ->orWhere('slug_vi', 'gioi-thieu-chung')
                    ->orWhere('slug_en', 'gioi-thieu-chung');
            })
            ->first();

        return view('pages.about.gioi-thieu-chung', compact('page'));
    }

    public function thuChuTich(): View
    {
        $page = Page::query()
            ->published()
            ->where(function ($query) {
                $query->where('type', 'thu-chu-tich')
                    ->orWhere('slug_vi', 'thu-chu-tich')
                    ->orWhere('slug_en', 'thu-chu-tich');
            })
            ->first();

        return view('pages.about.thu-chu-tich', compact('page'));
    }

    public function banChapHanh(): View
    {
        $members = BoardMember::active()->get();

        return view('pages.about.ban-chap-hanh', compact('members'));
    }
}
