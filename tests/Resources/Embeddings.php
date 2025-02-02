<?php

use RAGFlow\Responses\Embeddings\CreateResponse;
use RAGFlow\Responses\Embeddings\CreateResponseEmbedding;
use RAGFlow\Responses\Embeddings\CreateResponseUsage;
use RAGFlow\Responses\Meta\MetaInformation;

test('create', function () {
    $client = mockClient('POST', 'embeddings', [
        'model' => 'text-similarity-babbage-001',
        'input' => 'The food was delicious and the waiter...',
    ], \RAGFlow\ValueObjects\Transporter\Response::from(embeddingList(), metaHeaders()));

    $result = $client->embeddings()->create([
        'model' => 'text-similarity-babbage-001',
        'input' => 'The food was delicious and the waiter...',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->object->toBe('list')
        ->embeddings->toBeArray()->toHaveCount(2)
        ->embeddings->each->toBeInstanceOf(CreateResponseEmbedding::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->embeddings[0])
        ->object->toBe('embedding')
        ->index->toBe(0)
        ->embedding->toBeArray()->toBe([
            -0.008906792,
            -0.013743395,
            0.009874112,
        ]);

    expect($result->usage)
        ->promptTokens->toBe(8)
        ->totalTokens->toBe(8);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
