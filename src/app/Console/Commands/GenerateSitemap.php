<?php

namespace App\Console\Commands;

use DateTimeImmutable;
use Illuminate\Console\Command;
use Spatie\Sheets\Facades\Sheets;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $sitemap = $this->sitemap();

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->components->info('Generated sitemap with '.count($sitemap->getTags()).' URL(s).');

        return self::SUCCESS;
    }

    public function sitemap(): Sitemap
    {
        $sitemap = Sitemap::create()->add([
            route('home'),
            route('about'),
            route('privacy'),
            route('terms'),
            route('faq'),
            route('blog.index'),
        ]);

        foreach (Sheets::collection('posts')->all()->sortBy('slug') as $post) {
            $sitemap->add(
                Url::create(route('blog.show', $post->slug))
                    ->setLastModificationDate(new DateTimeImmutable("@{$post->date}")),
            );
        }

        return $sitemap;
    }
}
