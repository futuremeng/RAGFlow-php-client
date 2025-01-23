<?php

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use RAGFlow\Exceptions\InvalidArgumentException;
use RAGFlow\Responses\Completions\CreateResponse;
use RAGFlow\Responses\Completions\CreateResponseChoice;
use RAGFlow\Responses\Completions\CreateResponseUsage;
use RAGFlow\Responses\Completions\CreateStreamedResponse;
use RAGFlow\Responses\Meta\MetaInformation;
use RAGFlow\Responses\StreamResponse;

test('create', function () {
    $client = mockClient('POST', 'completions', [
        'model' => 'da-vince',
        'prompt' => 'hi',
    ], \RAGFlow\ValueObjects\Transporter\Response::from(completion(), metaHeaders()));

    $result = $client->completions()->create([
        'model' => 'da-vince',
        'prompt' => 'hi',
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('cmpl-5uS6a68SwurhqAqLBpZtibIITICna')
        ->object->toBe('text_completion')
        ->created->toBe(1664136088)
        ->model->toBe('davinci')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeInstanceOf(CreateResponseUsage::class);

    expect($result->choices[0])
        ->text->toBe("el, she elaborates more on the Corruptor's role, suggesting K")
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBe('length');

    expect($result->usage)
        ->promptTokens->toBe(1)
        ->completionTokens->toBe(16)
        ->totalTokens->toBe(17);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('create throws an exception if stream option is true', function () {
    RAGFlow::client('foo')->completions()->create([
        'model' => 'da-vince',
        'prompt' => 'hi',
        'stream' => true,
    ]);
})->expectException(InvalidArgumentException::class);

test('create streamed', function () {
    $response = new Response(
        body: new Stream(completionStream()),
        headers: metaHeaders(),
    );

    $client = mockStreamClient('POST', 'completions', [
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'hi',
        'stream' => true,
    ], $response);

    $result = $client->completions()->createStreamed([
        'model' => 'gpt-3.5-turbo-instruct',
        'prompt' => 'hi',
    ]);

    expect($result)
        ->toBeInstanceOf(StreamResponse::class)
        ->toBeInstanceOf(IteratorAggregate::class);

    expect($result->getIterator())
        ->toBeInstanceOf(Iterator::class);

    expect($result->getIterator()->current())
        ->toBeInstanceOf(CreateStreamedResponse::class)
        ->id->toBe('cmpl-6wcyFqMKXiZffiydSfWHhjcgsf3KD')
        ->object->toBe('text_completion')
        ->created->toBe(1679430847)
        ->model->toBe('gpt-3.5-turbo-instruct')
        ->choices->toBeArray()->toHaveCount(1)
        ->choices->each->toBeInstanceOf(CreateResponseChoice::class)
        ->usage->toBeNull();

    expect($result->getIterator()->current()->choices[0])
        ->text->toBe('!')
        ->index->toBe(0)
        ->logprobs->toBe(null)
        ->finishReason->toBeNull();

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
