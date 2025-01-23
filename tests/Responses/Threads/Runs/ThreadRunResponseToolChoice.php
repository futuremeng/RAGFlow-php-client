<?php

use RAGFlow\Responses\Threads\Runs\ThreadRunResponseToolChoice;
use RAGFlow\Responses\Threads\Runs\ThreadRunResponseToolChoiceFunction;

test('from', function () {
    $result = ThreadRunResponseToolChoice::from(threadRunWithToolChoiceFunction()['tool_choice']);

    expect($result)
        ->type->toBe('function')
        ->function->toBeInstanceOf(ThreadRunResponseToolChoiceFunction::class);
});

test('as array accessible', function () {
    $result = ThreadRunResponseToolChoice::from(threadRunWithToolChoiceFunction()['tool_choice']);

    expect($result['type'])
        ->toBe('function');
});

test('to array', function () {
    $result = ThreadRunResponseToolChoice::from(threadRunWithToolChoiceFunction()['tool_choice']);

    expect($result->toArray())
        ->toBe(threadRunWithToolChoiceFunction()['tool_choice']);
});
