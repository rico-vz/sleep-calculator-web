<?php

return [
    'default_collection' => null,

    'collections' => [


        'posts' => [
            'disk' => 'posts',
            'sheet_class' => Spatie\Sheets\Sheet::class,
            'path_parser' => Spatie\Sheets\PathParsers\SlugWithDateParser::class,
            'content_parser' => Spatie\Sheets\ContentParsers\MarkdownParser::class,
            'extension' => 'md',
        ],
    ],
];
