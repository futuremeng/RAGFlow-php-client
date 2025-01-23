<?php

use RAGFlow\Responses\Chat\CreateResponseUsage;
use RAGFlow\Responses\Chat\CreateResponseUsageCompletionTokensDetails;
use RAGFlow\Responses\Chat\CreateResponseUsagePromptTokensDetails;

test('from', function () {
    $result = CreateResponseUsage::from(chatCompletion()['usage']);

    expect($result)
        ->promptTokens->toBe(9)
        ->completionTokens->toBe(12)
        ->totalTokens->toBe(21)
        ->promptTokensDetails->toBeInstanceOf(CreateResponseUsagePromptTokensDetails::class)
        ->completionTokensDetails->toBeInstanceOf(CreateResponseUsageCompletionTokensDetails::class);
});

test('to array', function () {
    $result = CreateResponseUsage::from(chatCompletion()['usage']);

    expect($result->toArray())
        ->toBe(chatCompletion()['usage']);
});
