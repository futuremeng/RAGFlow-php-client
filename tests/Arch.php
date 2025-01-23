<?php

test('contracts')
    ->expect('RAGFlow\Contracts')
    ->toOnlyUse([
        'RAGFlow\ValueObjects',
        'RAGFlow\Exceptions',
        'RAGFlow\Resources',
        'Psr\Http\Message\ResponseInterface',
        'RAGFlow\Responses',
    ])
    ->toBeInterfaces();

test('enums')
    ->expect('RAGFlow\Enums')
    ->toBeEnums();

test('exceptions')
    ->expect('RAGFlow\Exceptions')
    ->toOnlyUse([
        'Psr\Http\Client',
    ])->toImplement(Throwable::class);

test('resources')->expect('RAGFlow\Resources')->toOnlyUse([
    'RAGFlow\Contracts',
    'RAGFlow\ValueObjects',
    'RAGFlow\Exceptions',
    'RAGFlow\Responses',
]);

test('responses')->expect('RAGFlow\Responses')->toOnlyUse([
    'Http\Discovery\Psr17Factory',
    'RAGFlow\Enums',
    'RAGFlow\Exceptions\ErrorException',
    'RAGFlow\Exceptions\UnknownEventException',
    'RAGFlow\Contracts',
    'RAGFlow\Testing\Responses\Concerns',
    'Psr\Http\Message\ResponseInterface',
    'Psr\Http\Message\StreamInterface',
]);

test('value objects')->expect('RAGFlow\ValueObjects')->toOnlyUse([
    'Http\Discovery\Psr17Factory',
    'Http\Message\MultipartStream\MultipartStreamBuilder',
    'Psr\Http\Message\RequestInterface',
    'Psr\Http\Message\StreamInterface',
    'RAGFlow\Enums',
    'RAGFlow\Contracts',
    'RAGFlow\Responses\Meta\MetaInformation',
]);

test('client')->expect('RAGFlow\Client')->toOnlyUse([
    'RAGFlow\Resources',
    'RAGFlow\Contracts',
]);

test('ragflow')->expect('RAGFlow')->toOnlyUse([
    'GuzzleHttp\Client',
    'GuzzleHttp\Exception\ClientException',
    'Http\Discovery\Psr17Factory',
    'Http\Discovery\Psr18ClientDiscovery',
    'Http\Message\MultipartStream\MultipartStreamBuilder',
    'RAGFlow\Contracts',
    'RAGFlow\Resources',
    'Psr\Http\Client',
    'Psr\Http\Message\RequestInterface',
    'Psr\Http\Message\ResponseInterface',
    'Psr\Http\Message\StreamInterface',
])->ignoring('RAGFlow\Testing');
