<?php

namespace App\Http\Controllers;

use App\Models\TrainingProgram;
use App\Support\Locale;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TrainingController extends Controller
{
    public function index(): View
    {
        $programs = TrainingProgram::published()->paginate(9);

        return view('pages.training.index', compact('programs'));
    }

    public function show(string $slug): View
    {
        $program = TrainingProgram::query()
            ->published()
            ->where('slug_'.Locale::current(), $slug)
            ->first();

        if (! $program) {
            $program = TrainingProgram::query()
                ->published()
                ->where('slug_vi', $slug)
                ->orWhere('slug_en', $slug)
                ->first();
        }

        if (! $program) {
            throw new NotFoundHttpException;
        }

        $related = TrainingProgram::published()
            ->where('id', '!=', $program->id)
            ->take(3)
            ->get();

        return view('pages.training.show', compact('program', 'related'));
    }
}
