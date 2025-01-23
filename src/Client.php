<?php

declare(strict_types=1);

namespace RAGFlow;

use RAGFlow\Contracts\ClientContract;
use RAGFlow\Contracts\Resources\ThreadsContract;
use RAGFlow\Contracts\Resources\VectorStoresContract;
use RAGFlow\Contracts\TransporterContract;
use RAGFlow\Resources\Assistants;
use RAGFlow\Resources\Audio;
use RAGFlow\Resources\Batches;
use RAGFlow\Resources\Chat;
use RAGFlow\Resources\Completions;
use RAGFlow\Resources\Edits;
use RAGFlow\Resources\Embeddings;
use RAGFlow\Resources\Files;
use RAGFlow\Resources\FineTunes;
use RAGFlow\Resources\FineTuning;
use RAGFlow\Resources\Images;
use RAGFlow\Resources\Models;
use RAGFlow\Resources\Moderations;
use RAGFlow\Resources\Threads;
use RAGFlow\Resources\VectorStores;

final class Client implements ClientContract
{
    /**
     * Creates a Client instance with the given API token.
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }

    /**
     * Given a prompt, the model will return one or more predicted completions, and can also return the probabilities
     * of alternative tokens at each position.
     *
     * @see https://ragflow.server/docs/api-reference/completions
     */
    public function completions(): Completions
    {
        return new Completions($this->transporter);
    }

    /**
     * Given a chat conversation, the model will return a chat completion response.
     *
     * @see https://ragflow.server/docs/api-reference/chat
     */
    public function chat(): Chat
    {
        return new Chat($this->transporter);
    }

    /**
     * Get a vector representation of a given input that can be easily consumed by machine learning models and algorithms.
     *
     * @see https://ragflow.server/docs/api-reference/embeddings
     */
    public function embeddings(): Embeddings
    {
        return new Embeddings($this->transporter);
    }

    /**
     * Learn how to turn audio into text.
     *
     * @see https://ragflow.server/docs/api-reference/audio
     */
    public function audio(): Audio
    {
        return new Audio($this->transporter);
    }

    /**
     * Given a prompt and an instruction, the model will return an edited version of the prompt.
     *
     * @see https://ragflow.server/docs/api-reference/edits
     */
    public function edits(): Edits
    {
        return new Edits($this->transporter);
    }

    /**
     * Files are used to upload documents that can be used with features like Fine-tuning.
     *
     * @see https://ragflow.server/docs/api-reference/files
     */
    public function files(): Files
    {
        return new Files($this->transporter);
    }

    /**
     * List and describe the various models available in the API.
     *
     * @see https://ragflow.server/docs/api-reference/models
     */
    public function models(): Models
    {
        return new Models($this->transporter);
    }

    /**
     * Manage fine-tuning jobs to tailor a model to your specific training data.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tuning
     */
    public function fineTuning(): FineTuning
    {
        return new FineTuning($this->transporter);
    }

    /**
     * Manage fine-tuning jobs to tailor a model to your specific training data.
     *
     * @see https://ragflow.server/docs/api-reference/fine-tunes
     * @deprecated RAGFlow has deprecated this endpoint and will stop working by January 4, 2024.
     * https://ragflow.com/blog/gpt-3-5-turbo-fine-tuning-and-api-updates#updated-gpt-3-models
     */
    public function fineTunes(): FineTunes
    {
        return new FineTunes($this->transporter);
    }

    /**
     * Given an input text, outputs if the model classifies it as violating RAGFlow's content policy.
     *
     * @see https://ragflow.server/docs/api-reference/moderations
     */
    public function moderations(): Moderations
    {
        return new Moderations($this->transporter);
    }

    /**
     * Given a prompt and/or an input image, the model will generate a new image.
     *
     * @see https://ragflow.server/docs/api-reference/images
     */
    public function images(): Images
    {
        return new Images($this->transporter);
    }

    /**
     * Build assistants that can call models and use tools to perform tasks.
     *
     * @see https://ragflow.server/docs/api-reference/assistants
     */
    public function assistants(): Assistants
    {
        return new Assistants($this->transporter);
    }

    /**
     * Create threads that assistants can interact with.
     *
     * @see https://ragflow.server/docs/api-reference/threads
     */
    public function threads(): ThreadsContract
    {
        return new Threads($this->transporter);
    }

    /**
     * Create large batches of API requests for asynchronous processing. The Batch API returns completions within 24 hours.
     *
     * @see https://ragflow.server/docs/api-reference/batch
     */
    public function batches(): Batches
    {
        return new Batches($this->transporter);
    }

    /**
     * Create and update vector stores that assistants can interact with
     *
     * @see https://ragflow.server/docs/api-reference/vector-stores
     */
    public function vectorStores(): VectorStoresContract
    {
        return new VectorStores($this->transporter);
    }
}
