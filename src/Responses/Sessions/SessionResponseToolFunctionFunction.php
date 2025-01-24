<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 17:18:58
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-23 17:21:44
 * @FilePath: /RAGFlow-php-client/src/Responses/Sessions/SessionResponseToolFunctionFunction.php
 * @Description: 
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{description: ?string, name: string, parameters: array<string, mixed>}>
 */
final class SessionResponseToolFunctionFunction implements ResponseContract
{
    /**
     * @use ArrayAccessible<array{description: ?string, name: string, parameters: array<string, mixed>}>
     */
    use ArrayAccessible;

    use Fakeable;

    /**
     * @param  array<string, mixed>  $parameters
     */
    private function __construct(
        public ?string $description,
        public string $name,
        public array $parameters,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{description: ?string, name: string, parameters: array<string, mixed>}  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            $attributes['description'],
            $attributes['name'],
            $attributes['parameters'],
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'parameters' => $this->parameters,
        ];
    }
}
