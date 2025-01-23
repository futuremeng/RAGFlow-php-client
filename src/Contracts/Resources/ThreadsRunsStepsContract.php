<?php

namespace RAGFlow\Contracts\Resources;

use RAGFlow\Responses\Threads\Runs\Steps\ThreadRunStepListResponse;
use RAGFlow\Responses\Threads\Runs\Steps\ThreadRunStepResponse;

interface ThreadsRunsStepsContract
{
    /**
     * Retrieves a run step.
     *
     * @see https://ragflow-server/docs/api-reference/runs/getRunStep
     */
    public function retrieve(string $threadId, string $runId, string $stepId): ThreadRunStepResponse;

    /**
     * Returns a list of run steps belonging to a run.
     *
     * @see https://ragflow-server/docs/api-reference/runs/listRunSteps
     *
     * @param  array<string, mixed>  $parameters
     */
    public function list(string $threadId, string $runId, array $parameters = []): ThreadRunStepListResponse;
}
