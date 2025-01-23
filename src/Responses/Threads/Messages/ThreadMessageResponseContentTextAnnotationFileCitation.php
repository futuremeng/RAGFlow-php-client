<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Threads\Messages;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{file_id: string, quote?: string}>
 */
final class ThreadMessageResponseContentTextAnnotationFileCitation implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{file_id: string, quote?: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $fileId,
        public ?string $quote,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{file_id: string, quote?: string}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['file_id'],
            $attributes['quote'] ?? null,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'file_id' => $this->fileId,
            'quote' => $this->quote,
        ], fn (?string $value): bool => $value !== null);
    }
}
