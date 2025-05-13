<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;
use Spatie\LaravelPasskeys\Actions\GeneratePasskeyRegisterOptionsAction;
use Spatie\LaravelPasskeys\Actions\StorePasskeyAction;
use Throwable;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasskeyController extends Controller
{
    /**
     * Show the user's passkey settings page.
     */
    public function edit(): Response
    {
        $user = auth()->user();
        $passkeys = $user->passkeys()
            ->get()
            ->map(fn($key) => $key->only(['id', 'name', 'last_used_at']));

        return Inertia::render('settings/Passkeys', [
            'passkeys' => $passkeys,
        ]);
    }

    /**
     * Generate passkey options.
     * # Like 'generatePasskeyOptions'
     */
    public function generateOptions()
    {
        $generatePassKeyOptionsAction = app(GeneratePasskeyRegisterOptionsAction::class);
        return $generatePassKeyOptionsAction->execute(auth()->user());
    }

    /**
     * Create a new passkey.
     * # Like 'storePassKey'
     */
    public function create(Request $request)
    {
        $data = request()->validate([
            'passkey' => 'required|json',
            'options' => 'required|json',
        ]);

        $user = auth()->user();
        $storePasskeyAction = app(StorePasskeyAction::class);

        try {
            $storePasskeyAction->execute(
                $user,
                $data['passkey'],
                $data['options'],
                request()->getHost(),
                ['name' => Str::random(10)],
            );

            return redirect()->back();
        } catch (Throwable $e) {
            throw ValidationException::withMessages([
                'name' => __('passkeys::passkeys.error_something_went_wrong_generating_the_passkey'),
            ]);
        }
    }

    /**
     * Delete a passkey.
     * # Like 'deletePasskey'
     */
    public function destroy(string $id)
    {
        auth()->user()->passkeys()->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Passkey deleted successfully.');
    }
}
