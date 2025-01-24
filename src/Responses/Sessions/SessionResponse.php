<?php
/*
 * @Author: FutureMeng futuremeng@gmail.com
 * @Date: 2025-01-23 17:18:58
 * @LastEditors: FutureMeng futuremeng@gmail.com
 * @LastEditTime: 2025-01-23 17:21:16
 * @FilePath: /RAGFlow-php-client/src/Responses/Sessions/SessionResponse.php
 * @Description: 
 * Copyright (c) 2025 by Jiulu.ltd, All Rights Reserved.
 */

declare(strict_types=1);

namespace RAGFlow\Responses\Sessions;

use RAGFlow\Contracts\ResponseContract;
use RAGFlow\Contracts\ResponseHasMetaInformationContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;
use RAGFlow\Responses\Concerns\HasMetaInformation;
use RAGFlow\Responses\Meta\MetaInformation;
use RAGFlow\Testing\Responses\Concerns\Fakeable;

/**
 * @implements ResponseContract<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: string}|array{type: string}|array{type: string, function: array{description: ?string, name: string, parameters: array<string, mixed>}}>, tool_resources: ?array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: string}}>
 */
final class SessionResponse implements ResponseContract, ResponseHasMetaInformationContract
{
    /**
     * @use ArrayAccessible<array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: string}|array{type: string}|array{type: string, function: array{description: ?string, name: string, parameters: array<string, mixed>}}>, tool_resources: ?array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: string}}>
     */
    use ArrayAccessible;

    use Fakeable;
    use HasMetaInformation;

    /**
     * @param  array<int, SessionResponseToolCodeInterpreter|SessionResponseToolFileSearch|SessionResponseToolFunction>  $tools
     * @param  array<string, string>  $metadata
     */
    private function __construct(
        public string $id,
        public string $object,
        public int $createdAt,
        public ?string $name,
        public ?string $description,
        public string $model,
        public ?string $instructions,
        public array $tools,
        public ?SessionResponseToolResources $toolResources,
        public array $metadata,
        public ?float $temperature,
        public ?float $topP,
        public string|SessionResponseResponseFormat $responseFormat,
        private readonly MetaInformation $meta,
    ) {}

    /**
     * Acts as static factory, and returns a new Response instance.
     *
     * @param  array{id: string, object: string, created_at: int, name: ?string, description: ?string, model: string, instructions: ?string, tools: array<int, array{type: 'code_interpreter'}|array{type: 'file_search'}|array{type: 'function', function: array{description: ?string, name: string, parameters: array<string, mixed>}}>, tool_resources: ?array{code_interpreter?: array{file_ids: array<int,string>}, file_search?: array{vector_store_ids: array<int,string>}}, metadata: array<string, string>, temperature: ?float, top_p: ?float, response_format: string|array{type: 'text'|'json_object'}}  $attributes
     */
    public static function from(array $attributes, MetaInformation $meta): self
    {
        $tools = array_map(
            fn (array $tool): SessionResponseToolCodeInterpreter|SessionResponseToolFileSearch|SessionResponseToolFunction => match ($tool['type']) {
                'code_interpreter' => SessionResponseToolCodeInterpreter::from($tool),
                'file_search' => SessionResponseToolFileSearch::from($tool),
                'function' => SessionResponseToolFunction::from($tool),
            },
            $attributes['tools'],
        );

        $responseFormat = is_array($attributes['response_format']) ?
            SessionResponseResponseFormat::from($attributes['response_format']) :
            $attributes['response_format'];

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created_at'],
            $attributes['name'],
            $attributes['description'],
            $attributes['model'],
            $attributes['instructions'],
            $tools,
            isset($attributes['tool_resources']) ? SessionResponseToolResources::from($attributes['tool_resources']) : null,
            $attributes['metadata'],
            $attributes['temperature'],
            $attributes['top_p'],
            $responseFormat,
            $meta
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'object' => $this->object,
            'created_at' => $this->createdAt,
            'name' => $this->name,
            'description' => $this->description,
            'model' => $this->model,
            'instructions' => $this->instructions,
            'tools' => array_map(fn (SessionResponseToolCodeInterpreter|SessionResponseToolFileSearch|SessionResponseToolFunction $tool): array => $tool->toArray(), $this->tools),
            'tool_resources' => $this->toolResources?->toArray(),
            'metadata' => $this->metadata,
            'temperature' => $this->temperature,
            'top_p' => $this->topP,
            'response_format' => is_string($this->responseFormat) ? $this->responseFormat : $this->responseFormat->toArray(),
        ];
    }
}
