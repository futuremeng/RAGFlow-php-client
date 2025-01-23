<?php

namespace RAGFlow\Contracts;

use RAGFlow\Contracts\Resources\AssistantsContract;
use RAGFlow\Contracts\Resources\AudioContract;
use RAGFlow\Contracts\Resources\BatchesContract;
use RAGFlow\Contracts\Resources\ChatContract;
use RAGFlow\Contracts\Resources\CompletionsContract;
use RAGFlow\Contracts\Resources\EditsContract;
use RAGFlow\Contracts\Resources\EmbeddingsContract;
use RAGFlow\Contracts\Resources\FilesContract;
use RAGFlow\Contracts\Resources\FineTunesContract;
use RAGFlow\Contracts\Resources\FineTuningContract;
use RAGFlow\Contracts\Resources\ImagesContract;
use RAGFlow\Contracts\Resources\ModelsContract;
use RAGFlow\Contracts\Resources\ModerationsContract;
use RAGFlow\Contracts\Resources\ThreadsContract;
use RAGFlow\Contracts\Resources\VectorStoresContract;

interface ClientContract
{
    /**
     * Given a prompt, the model will return one or more predicted completions, and can also return the probabilities
     * of alternative tokens at each position.
     *
     * @see https://ragflow.server/docs/api-reference/completions
     */
    public function completions(): CompletionsContract;

    /**
     * Given a chat conversation, the model will return a chat completion response.
     *
     * @see https://ragflow.server/docs/api-reference/chat
     */
    public function chat(): ChatContract;

    /**
     * Get a vector representation of a given input that can be easily consumed by machine learning models and algorithms.
     *
     * @see https://ragflow.server/docs/api-reference/embeddings
     */
    public function embeddings(): EmbeddingsContract;

    /**
     * Learn how to turn audio into text.
     *
     * @see https://ragflow.server/docs/api-reference/audio
     */
    public function audio(): AudioContract;

    /**
     * Given a prompt and an instruction, the model will return an edited version of the prompt.
     *
     * @see https://ragflow.server/docs/api-reference/edits
     * @deprecated RAGFlow has deprecated this endpoint and will stop working by January 4, 2024.
     * https://ragflow.com/blog/gpt-4-api-general-availability#deprecation-of-the-edits-api
     */
    public function edits(): EditsContract;

    /**
     * Files are used to upload documents that can be used with features like Fine-tuning.
     *
     * @see https://ragflow.server/docs/api-reference/files
     */
    public function files(): FilesContract;

    /**
     * List and describe the various models available in the API.
     *
     * @see https://ragflow.server/docs/api-reference/models
     */
    public function models(): ModelsContract;

    /**
     * Manage fine-tuning jobs to tailor a model to your specific training data.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tuning
     */
    public function fineTuning(): FineTuningContract;

    /**
     * Manage fine-tuning jobs to tailor a model to your specific training data.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tunes
     * @deprecated RAGFlow has deprecated this endpoint and will stop working by January 4, 2024.
     * https://ragflow.com/blog/gpt-3-5-turbo-fine-tuning-and-api-updates#updated-gpt-3-models
     */
    public function fineTunes(): FineTunesContract;

    /**
     * Given an input text, outputs if the model classifies it as violating RAGFlow's content policy.
     *
     * @see https://ragflow.server/docs/api-reference/moderations
     */
    public function moderations(): ModerationsContract;

    /**
     * Given a prompt and/or an input image, the model will generate a new image.
     *
     * @see https://ragflow.server/docs/api-reference/images
     */
    public function images(): ImagesContract;

    /**
     * Build assistants that can call models and use tools to perform tasks.
     *
     * @see https://ragflow.server/docs/api-reference/assistants
     */
    public function assistants(): AssistantsContract;

    /**
     * Create threads that assistants can interact with.
     *
     * @see https://ragflow.server/docs/api-reference/threads
     */
    public function threads(): ThreadsContract;

    /**
     * Create large batches of API requests for asynchronous processing. The Batch API returns completions within 24 hours.
     *
     * @see https://ragflow.server/docs/api-reference/batch
     */
    public function batches(): BatchesContract;

    /**
     * Create and update vector stores that assistants can interact with
     *
     * @see https://ragflow.server/docs/api-reference/vector-stores
     */
    public function vectorStores(): VectorStoresContract;
}
