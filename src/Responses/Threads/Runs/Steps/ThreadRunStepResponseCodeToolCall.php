<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Threads\Runs\Steps;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: ?string, type: 'code_interpreter', code_interpreter: array{input?: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}>
 */
final class ThreadRunStepResponseCodeToolCall implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{id: ?string, type: 'code_interpreter', code_interpreter: array{input?: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  'code_interpreter'  $type
     */
    private function __construct(
        public ?string $id,
        public string $type,
        public ThreadRunStepResponseCodeInterpreter $codeInterpreter,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id?: string, type: 'code_interpreter', code_interpreter: array{input?: string, outputs?: array<int, array{type: 'image', image: array{file_id: string}}|array{type: 'logs', logs: string}>}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'] ?? null,
            $attributes['type'],
            ThreadRunStepResponseCodeInterpreter::from($attributes['code_interpreter']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'code_interpreter' => $this->codeInterpreter->toArray(),
        ];
    }
}
