<?php

use RAGFlow\Enums\Transporter\ContentType;
use RAGFlow\ValueObjects\ApiKey;
use RAGFlow\ValueObjects\Transporter\Headers;

it('can be created from an API Token', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'));

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
    ]);
});

it('can have content/type', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'))
        ->withContentType(ContentType::JSON);

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
    ]);
});

it('can have content/type with suffix', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'))
        ->withContentType(ContentType::MULTIPART, '; boundary=---XYZ');

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'multipart/form-data; boundary=---XYZ',
    ]);
});

it('can have organization', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'))
        ->withContentType(ContentType::JSON)
        ->withOrganization('nunomaduro');

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
        'RAGFlow-Organization' => 'nunomaduro',
    ]);
});

it('can have project', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'))
        ->withContentType(ContentType::JSON)
        ->withProject('ragflow_proj');

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
        'RAGFlow-Project' => 'ragflow_proj',
    ]);
});

it('can have custom header', function () {
    $headers = Headers::withAuthorization(ApiKey::from('foo'))
        ->withContentType(ContentType::JSON)
        ->withCustomHeader('X-Foo', 'bar');

    expect($headers->toArray())->toBe([
        'Authorization' => 'Bearer foo',
        'Content-Type' => 'application/json',
        'X-Foo' => 'bar',
    ]);
});
