<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\VectorStoresContract;
use RAGFlow\Contracts\Resources\VectorStoresFileBatchesContract;
use RAGFlow\Contracts\Resources\VectorStoresFilesContract;
use RAGFlow\Resources\VectorStores;
use RAGFlow\Responses\VectorStores\VectorStoreDeleteResponse;
use RAGFlow\Responses\VectorStores\VectorStoreListResponse;
use RAGFlow\Responses\VectorStores\VectorStoreResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class VectorStoresTestResource implements VectorStoresContract
{
    use Testable;

    public function resource(): string
    {
        return VectorStores::class;
    }

    public function modify(string $vectorStoreId, array $parameters): VectorStoreResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function retrieve(string $vectorStoreId): VectorStoreResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $vectorStoreId): VectorStoreDeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function create(array $parameters): VectorStoreResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(array $parameters = []): VectorStoreListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function files(): VectorStoresFilesContract
    {
        return new VectorStoresFilesTestResource($this->fake);
    }

    public function batches(): VectorStoresFileBatchesContract
    {
        return new VectorStoresFileBatchesTestResource($this->fake);
    }
}
