<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Models\DeleteResponse;
use RAGFlow\Responses\Models\ListResponse;
use RAGFlow\Responses\Models\RetrieveResponse;

interface ModelsContract
{
    /**
     * Lists the currently available models, and provides basic information about each one such as the owner and availability.
     *
     * @see https://ragflow.server/docs/api-reference/models/list
     */
    public function list(): ListResponse;

    /**
     * Retrieves a model instance, providing basic information about the model such as the owner and permissioning.
     *
     * @see https://ragflow.server/docs/api-reference/models/retrieve
     */
    public function retrieve(string $model): RetrieveResponse;

    /**
     * Delete a fine-tuned model. You must have the Owner role in your organization.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tunes/delete-model
     */
    public function delete(string $model): DeleteResponse;
}
