<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\VectorStoresFilesContract;
use RAGFlow\Resources\VectorStoresFiles;
use RAGFlow\Responses\VectorStores\Files\VectorStoreFileDeleteResponse;
use RAGFlow\Responses\VectorStores\Files\VectorStoreFileListResponse;
use RAGFlow\Responses\VectorStores\Files\VectorStoreFileResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class VectorStoresFilesTestResource implements VectorStoresFilesContract
{
    use Testable;

    public function resource(): string
    {
        return VectorStoresFiles::class;
    }

    public function retrieve(string $vectorStoreId, string $fileId): VectorStoreFileResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function delete(string $vectorStoreId, string $fileId): VectorStoreFileDeleteResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function create(string $vectorStoreId, array $parameters): VectorStoreFileResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $vectorStoreId, array $parameters = []): VectorStoreFileListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
