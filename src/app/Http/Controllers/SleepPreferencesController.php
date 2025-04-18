<?php

namespace App\Http\Controllers;

use App\Models\SleepPreferences;
use App\Http\Requests\UpdateSleepPreferencesRequest;
use Inertia\Inertia;

class SleepPreferencesController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SleepPreferences $sleepPreferences)
    {
        return Inertia::render('settings/SleepPreferences', [
            'sleepPreferences' => $sleepPreferences,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSleepPreferencesRequest $request, SleepPreferences $sleepPreferences)
    {
        $validated = $request->validated();
        $request->user()->sleepPreferences->update($validated);

        return redirect()->back()->with('success', 'Sleep preferences updated successfully.');
    }
}
