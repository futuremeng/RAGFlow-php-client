<?php

use RAGFlow\Resources\Embeddings;
use RAGFlow\Responses\Embeddings\CreateResponse;
use RAGFlow\Testing\ClientFake;

it('records a embeddings create request', function () {
    $fake = new ClientFake([
        CreateResponse::fake(),
    ]);

    $fake->embeddings()->create([
        'model' => 'text-similarity-babbage-001',
        'input' => 'The food was delicious and the waiter...',
    ]);

    $fake->assertSent(Embeddings::class, function ($method, $parameters) {
        return $method === 'create' &&
            $parameters['model'] === 'text-similarity-babbage-001' &&
            $parameters['input'] === 'The food was delicious and the waiter...';
    });
});
