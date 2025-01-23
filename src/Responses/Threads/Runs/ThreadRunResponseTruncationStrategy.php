<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Threads\Runs;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: string, last_messages: ?int}>
 */
final class ThreadRunResponseTruncationStrategy implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: string, last_messages: ?int}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $type,
        public ?int $lastMessages,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: string, last_messages: ?int}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            $attributes['last_messages'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'last_messages' => $this->lastMessages,
        ];
    }
}
