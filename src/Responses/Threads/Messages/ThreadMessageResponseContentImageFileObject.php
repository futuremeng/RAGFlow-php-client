<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Threads\Messages;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: string, image_file: array{file_id: string, detail?: string}}>
 */
final class ThreadMessageResponseContentImageFileObject implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: string, image_file: array{file_id: string, detail?: string}}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $type,
        public ThreadMessageResponseContentImageFile $imageFile,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: string, image_file: array{file_id: string, detail?: string}}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
            ThreadMessageResponseContentImageFile::from($attributes['image_file']),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'image_file' => $this->imageFile->toArray(),
        ];
    }
}
