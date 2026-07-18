<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\Sheets\Facades\Sheets;
use Throwable;

#[Signature('content:validate-posts')]
#[Description('Validate blog post front matter')]
class ValidatePostFrontMatter extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $posts = Sheets::collection('posts')->all();
        } catch (Throwable $exception) {
            $this->components->error("Unable to parse post front matter: {$exception->getMessage()}");

            return self::FAILURE;
        }

        $errors = [];

        foreach ($posts as $post) {
            foreach (['title', 'date', 'excerpt', 'author'] as $field) {
                if (blank($post->{$field})) {
                    $errors[] = "{$post->getPath()}: missing {$field}";
                }
            }
        }

        $postFiles = File::files(base_path('content/posts'));

        if ($posts->count() !== count($postFiles)) {
            $errors[] = 'One or more post files could not be parsed.';
        }

        if ($errors !== []) {
            $this->components->error('Post front matter validation failed.');
            $this->components->bulletList($errors);

            return self::FAILURE;
        }

        $this->components->info("Validated {$posts->count()} blog post(s).");

        return self::SUCCESS;
    }
}
