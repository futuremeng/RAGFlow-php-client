<?php

use RAGFlow\Responses\Moderations\CreateResponseCategory;
use RAGFlow\Responses\Moderations\CreateResponseResult;

test('from', function () {
    $result = CreateResponseResult::from(moderationResource()['results'][0]);

    expect($result)
        ->flagged->toBeTrue()
        ->categories->toHaveCount(11)
        ->each->toBeInstanceOf(CreateResponseCategory::class);
});

test('to array', function () {
    $result = CreateResponseResult::from(moderationResource()['results'][0]);

    expect($result->toArray())
        ->toBe(moderationResource()['results'][0]);
});
