<?php

namespace RAGFlow\Responses\Meta;

use RAGFlow\Contracts\MetaInformationContract;
use RAGFlow\Responses\Concerns\ArrayAccessible;

/**
 * @implements MetaInformationContract<array{x-request-id?: string, ragflow-model?: string, ragflow-organization?: string, ragflow-processing-ms?: int, ragflow-version?: string, x-ratelimit-limit-requests?: int, x-ratelimit-limit-tokens?: int, x-ratelimit-remaining-requests?: int, x-ratelimit-remaining-tokens?: int, x-ratelimit-reset-requests?: string, x-ratelimit-reset-tokens?: string}>
 */
final class MetaInformation implements MetaInformationContract
{
    /**
     * @use ArrayAccessible<array{x-request-id?: string, ragflow-model?: string, ragflow-organization?: string, ragflow-processing-ms?: int, ragflow-version?: string, x-ratelimit-limit-requests?: int, x-ratelimit-limit-tokens?: int, x-ratelimit-remaining-requests?: int, x-ratelimit-remaining-tokens?: int, x-ratelimit-reset-requests?: string, x-ratelimit-reset-tokens?: string}>
     */
    use ArrayAccessible;

    private function __construct(
        public ?string $requestId,
        public readonly MetaInformationRAGFlow $ragflow,
        public readonly ?MetaInformationRateLimit $requestLimit,
        public readonly ?MetaInformationRateLimit $tokenLimit,
    ) {}

    /**
     * @param  array{x-request-id: string[], ragflow-model: string[], ragflow-organization: string[], ragflow-version: string[], ragflow-processing-ms: string[], x-ratelimit-limit-requests: string[], x-ratelimit-remaining-requests: string[], x-ratelimit-reset-requests: string[], x-ratelimit-limit-tokens: string[], x-ratelimit-remaining-tokens: string[], x-ratelimit-reset-tokens: string[]}  $headers
     */
    public static function from(array $headers): self
    {
        $headers = array_change_key_case($headers, CASE_LOWER);

        $requestId = $headers['x-request-id'][0] ?? null;

        $ragflow = MetaInformationRAGFlow::from([
            'model' => $headers['ragflow-model'][0] ?? null,
            'organization' => $headers['ragflow-organization'][0] ?? null,
            'version' => $headers['ragflow-version'][0] ?? null,
            'processingMs' => isset($headers['ragflow-processing-ms'][0]) ? (int) $headers['ragflow-processing-ms'][0] : null,
        ]);

        if (isset($headers['x-ratelimit-remaining-requests'][0])) {
            $requestLimit = MetaInformationRateLimit::from([
                'limit' => isset($headers['x-ratelimit-limit-requests'][0]) ? (int) $headers['x-ratelimit-limit-requests'][0] : null,
                'remaining' => (int) $headers['x-ratelimit-remaining-requests'][0],
                'reset' => $headers['x-ratelimit-reset-requests'][0] ?? null,
            ]);
        } else {
            $requestLimit = null;
        }

        if (isset($headers['x-ratelimit-remaining-tokens'][0])) {
            $tokenLimit = MetaInformationRateLimit::from([
                'limit' => isset($headers['x-ratelimit-limit-tokens'][0]) ? (int) $headers['x-ratelimit-limit-tokens'][0] : null,
                'remaining' => (int) $headers['x-ratelimit-remaining-tokens'][0],
                'reset' => $headers['x-ratelimit-reset-tokens'][0] ?? null,
            ]);
        } else {
            $tokenLimit = null;
        }

        return new self(
            $requestId,
            $ragflow,
            $requestLimit,
            $tokenLimit,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function toArray(): array
    {
        return array_filter([
            'ragflow-model' => $this->ragflow->model,
            'ragflow-organization' => $this->ragflow->organization,
            'ragflow-processing-ms' => $this->ragflow->processingMs,
            'ragflow-version' => $this->ragflow->version,
            'x-ratelimit-limit-requests' => $this->requestLimit->limit ?? null,
            'x-ratelimit-limit-tokens' => $this->tokenLimit->limit ?? null,
            'x-ratelimit-remaining-requests' => $this->requestLimit->remaining ?? null,
            'x-ratelimit-remaining-tokens' => $this->tokenLimit->remaining ?? null,
            'x-ratelimit-reset-requests' => $this->requestLimit->reset ?? null,
            'x-ratelimit-reset-tokens' => $this->tokenLimit->reset ?? null,
            'x-request-id' => $this->requestId,
        ], fn (string|int|null $value): bool => ! is_null($value));
    }
}
