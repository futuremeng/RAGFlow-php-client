<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 17:18:58
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-23 17:21:22
 * @FilePath: /RAGFlow-php-client/src/Responses/Sessions/SessionResponseResponseFormatText.php
 * @Description: 
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{type: string}>
 */
final class SessionResponseResponseFormatText implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{type: string}>
     */
    use ArrayAccessible;

    use Fakeable;

    private function __construct(
        public string $type,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{type: 'text'}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['type'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
