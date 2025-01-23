<?php

use RAGFlow\Enums\Transporter\ContentType;
use RAGFlow\ValueObjects\ApiKey;
use RAGFlow\ValueObjects\Transporter\BaseUri;
use RAGFlow\ValueObjects\Transporter\Headers;
use RAGFlow\ValueObjects\Transporter\Payload;
use RAGFlow\ValueObjects\Transporter\QueryParams;

it('has a method', function () {
    $payload = Payload::create('models', []);

    $baseUri = BaseUri::from('api.ragflow.server/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getMethod())->toBe('POST');
});

it('has a uri', function () {
    $payload = Payload::list('models');

    $baseUri = BaseUri::from('api.ragflow.server/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create()
        ->withParam('foo', 'bar')
        ->withParam('baz', 'qux');

    $uri = $payload->toRequest($baseUri, $headers, $queryParams)->getUri();

    expect($uri->getHost())->toBe('api.ragflow.server')
        ->and($uri->getScheme())->toBe('https')
        ->and($uri->getPath())->toBe('/v1/models')
        ->and($uri->getQuery())->toBe('foo=bar&baz=qux');
});

test('get verb does not have a body', function () {
    $payload = Payload::list('models');

    $baseUri = BaseUri::from('api.ragflow.server/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getBody()->getContents())->toBe('');
});

test('post verb has a body', function () {
    $payload = Payload::create('models', [
        'name' => 'test',
    ]);

    $baseUri = BaseUri::from('api.ragflow.server/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'))->withContentType(ContentType::JSON);
    $queryParams = QueryParams::create();

    expect($payload->toRequest($baseUri, $headers, $queryParams)->getBody()->getContents())->toBe(json_encode([
        'name' => 'test',
    ]));
});

test('builds upload request', function () {
    $payload = Payload::upload('files', [
        'purpose' => 'fine-tune',
        'file' => fileResourceResource(),
    ]);

    $baseUri = BaseUri::from('api.ragflow.server/v1');
    $headers = Headers::withAuthorization(ApiKey::from('foo'));
    $queryParams = QueryParams::create();

    $request = $payload->toRequest($baseUri, $headers, $queryParams);

    expect($request->getHeader('Content-Type')[0])
        ->toMatch('/multipart\/form-data; boundary=.+/');

    expect($request->getBody()->getContents())
        ->toContain('Content-Disposition: form-data; name="purpose"')
        ->toContain('Content-Disposition: form-data; name="file"; filename="MyFile.jsonl"')
        ->toContain('{"prompt": "<prompt text>", "completion": "<ideal generated text>"}');
});
