<?php

namespace App\Http\Controllers;

use Spatie\Sheets\Facades\Sheets;
use Inertia\Inertia;

class ChangelogController extends Controller
{
    public function show()
    {
        $changelog = Sheets::collection('changelog')->get('changelogs');
        $content = (string) $changelog->contents;

        return Inertia::render('Changelog', [
            'changelog' => $changelog,
            'content' => $content,
        ]);
    }
}
