<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\VectorStores\FileBatches\VectorStoreFileBatchResponse;
use RAGFlow\Responses\VectorStores\Files\VectorStoreFileListResponse;

interface VectorStoresFileBatchesContract
{
    /**
     * Create a file batch on a vector store
     *
     * @see https://ragflow-server/docs/api-reference/vector-stores-file-batches/createBatch
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(string $vectorStoreId, array $parameters): VectorStoreFileBatchResponse;

    /**
     * Retrieves a file batch within a vector store.
     *
     * @see https://ragflow-server/docs/api-reference/vector-stores-file-batches/getBatch
     */
    public function retrieve(string $vectorStoreId, string $fileBatchId): VectorStoreFileBatchResponse;

    /**
     * Cancel a vector store file batch
     *
     * @see https://ragflow-server/docs/api-reference/vector-stores-file-batches/cancelBatch
     */
    public function cancel(string $vectorStoreId, string $fileBatchId): VectorStoreFileBatchResponse;

    /**
     * Lists the files within a file batch within a vector store
     *
     * @see https://ragflow-server/docs/api-reference/vector-stores-file-batches/listBatchFiles
     *
     * @param  array<string, mixed>  $parameters
     */
    public function listFiles(string $vectorStoreId, string $fileBatchId, array $parameters = []): VectorStoreFileListResponse;
}
