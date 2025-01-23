<?php

use RAGFlow\Responses\Files\CreateResponse;
use RAGFlow\Responses\Files\DeleteResponse;
use RAGFlow\Responses\Files\ListResponse;
use RAGFlow\Responses\Files\RetrieveResponse;
use RAGFlow\Responses\Meta\MetaInformation;

test('list', function () {
    $client = mockClient('GET', 'files', [], \RAGFlow\ValueObjects\Transporter\Response::from(fileListResource(), metaHeaders()));

    $result = $client->files()->list();

    expect($result)
        ->toBeInstanceOf(ListResponse::class)
        ->object->toBe('list')
        ->data->toBeArray()->toHaveCount(2)
        ->data->each->toBeInstanceOf(RetrieveResponse::class);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('retrieve', function () {
    $client = mockClient('GET', 'files/file-XjGxS3KTG0uNmNOK362iJua3', [], \RAGFlow\ValueObjects\Transporter\Response::from(fileResource(), metaHeaders()));

    $result = $client->files()->retrieve('file-XjGxS3KTG0uNmNOK362iJua3');

    expect($result)
        ->toBeInstanceOf(RetrieveResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->bytes->toBe(140)
        ->createdAt->toBe(1613779121)
        ->filename->toBe('mydata.jsonl')
        ->purpose->toBe('fine-tune');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('download', function () {
    $client = mockContentClient('GET', 'files/file-XjGxS3KTG0uNmNOK362iJua3/content', [], fileContentResource());

    $result = $client->files()->download('file-XjGxS3KTG0uNmNOK362iJua3');

    expect($result)->toBeString()->toBe(fileContentResource());
});

test('upload', function () {
    $client = mockClient('POST', 'files', [
        'purpose' => 'fine-tune',
        'file' => fileResourceResource(),
    ], \RAGFlow\ValueObjects\Transporter\Response::from(fileResource(), metaHeaders()), validateParams: false);

    $result = $client->files()->upload([
        'purpose' => 'fine-tune',
        'file' => fileResourceResource(),
    ]);

    expect($result)
        ->toBeInstanceOf(CreateResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->bytes->toBe(140)
        ->createdAt->toBe(1613779121)
        ->filename->toBe('mydata.jsonl')
        ->purpose->toBe('fine-tune');

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});

test('delete', function () {
    $client = mockClient('DELETE', 'files/file-XjGxS3KTG0uNmNOK362iJua3', [], \RAGFlow\ValueObjects\Transporter\Response::from(fileDeleteResource(), metaHeaders()));

    $result = $client->files()->delete('file-XjGxS3KTG0uNmNOK362iJua3');

    expect($result)
        ->toBeInstanceOf(DeleteResponse::class)
        ->id->toBe('file-XjGxS3KTG0uNmNOK362iJua3')
        ->object->toBe('file')
        ->deleted->toBe(true);

    expect($result->meta())
        ->toBeInstanceOf(MetaInformation::class);
});
