<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\ThreadsRunsStepsContract;
use RAGFlow\Resources\ThreadsRunsSteps;
use RAGFlow\Responses\Threads\Runs\Steps\ThreadRunStepListResponse;
use RAGFlow\Responses\Threads\Runs\Steps\ThreadRunStepResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

class ThreadsRunsStepsTestResource implements ThreadsRunsStepsContract
{
    use Testable;

    public function resource(): string
    {
        return ThreadsRunsSteps::class;
    }

    public function retrieve(string $threadId, string $runId, string $stepId): ThreadRunStepResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function list(string $threadId, string $runId, array $parameters = []): ThreadRunStepListResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
