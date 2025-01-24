<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 17:18:58
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-23 17:21:53
 * @FilePath: /RAGFlow-php-client/src/Responses/Sessions/SessionResponseToolResourceCodeInterpreter.php
 * @Description: 
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{file_ids: array<int,string>}>
 */
final class SessionResponseToolResourceCodeInterpreter implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{file_ids: array<int,string>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<int, string>  $fileIds
     */
    private function __construct(
        public array $fileIds,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{file_ids: array<int,string>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['file_ids'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'file_ids' => $this->fileIds,
        ];
    }
}
