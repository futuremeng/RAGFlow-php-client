<?php

namespace RAGFlow\Testing\Responses\Fixtures\Models;

final class ListResponseFixture
{
    public const ATTRIBUTES = [
        'object' => 'list',
        'data' => [
            RetrieveResponseFixture::ATTRIBUTES,
        ],
    ];
}
