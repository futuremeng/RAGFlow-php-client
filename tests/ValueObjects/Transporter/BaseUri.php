<?php

use RAGFlow\ValueObjects\Transporter\BaseUri;

it('can be created from a string', function () {
    $baseUri = BaseUri::from('api.ragflow.server/v1');

    expect($baseUri->toString())->toBe('https://api.ragflow.server/v1/');
});

it('can be created from a string with http protocol', function () {
    $baseUri = BaseUri::from('http://api.ragflow.server/v1');

    expect($baseUri->toString())->toBe('http://api.ragflow.server/v1/');
});

it('can be created from a string with https protocol', function () {
    $baseUri = BaseUri::from('https://api.ragflow.server/v1');

    expect($baseUri->toString())->toBe('https://api.ragflow.server/v1/');
});
