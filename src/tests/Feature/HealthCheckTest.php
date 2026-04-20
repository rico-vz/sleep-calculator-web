<?php

namespace Tests\Feature;

use Illuminate\Contracts\Process\ProcessResult;
use Illuminate\Process\PendingProcess;
use Illuminate\Support\Facades\Process;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    public function test_health_check_shows_commit_metadata(): void
    {
        Process::fake([
            'git rev-parse --short HEAD' => Process::result(output: 'abc1234'),
            'git show -s --format=%cI HEAD' => Process::result(output: '2026-04-19T12:34:56+00:00'),
        ]);

        $response = $this->get('/up');

        $response->assertOk();
        $response->assertSeeText('Application up');
        $response->assertSeeText('Latest deployed commit:');
        $response->assertSeeText('abc1234');
        $response->assertSeeText('Commit date:');
        $response->assertSeeText('Sun, Apr 19, 2026 12:34 PM');
        Process::assertRan(fn (PendingProcess $process, ProcessResult $result) => $process->command === 'git rev-parse --short HEAD');
        Process::assertRan(fn (PendingProcess $process, ProcessResult $result) => $process->command === 'git show -s --format=%cI HEAD');
    }

    public function test_health_check_shows_unknown_when_git_metadata_is_unavailable(): void
    {
        Process::fake([
            'git rev-parse --short HEAD' => Process::result(exitCode: 1),
        ]);

        $response = $this->get('/up');

        $response->assertOk();
        $response->assertSeeText('Latest deployed commit: unknown');
        $response->assertSeeText('Commit date: unknown');
    }
}
