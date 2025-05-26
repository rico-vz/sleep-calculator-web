<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class BackupsController extends Controller
{
    public function index(Request $request)
    {
        if (! $request->user()->can('view backups')) {
            abort(403, 'Unauthorized action.');
        }

        $backups = Storage::files("backups");

        return Inertia::render('Backups', [
            'backups' => $backups,
        ]);
    }

    public function download(Request $request, $filename)
    {
        if (! $request->user()->can('download backups')) {
            abort(403, 'Unauthorized action.');
        }

        $filePath = "backups/{$filename}";

        if (! Storage::exists($filePath)) {
            abort(404, 'Backup file not found.');
        }

        return Storage::download($filePath);
    }

    public function delete(Request $request, $filename)
    {
        if (! $request->user()->can('delete backups')) {
            abort(403, 'Unauthorized action.');
        }

        $filePath = "backups/{$filename}";

        if (! Storage::exists($filePath)) {
            abort(404, 'Backup file not found.');
        }

        Storage::delete($filePath);

        return redirect()->route('dashboard.backups')->with('success', 'Backup deleted successfully.');
    }
}
