<?php

namespace RAGFlow\Testing\Resources;

use RAGFlow\Contracts\Resources\AudioContract;
use RAGFlow\Resources\Audio;
use RAGFlow\Responses\Audio\SpeechStreamResponse;
use RAGFlow\Responses\Audio\TranscriptionResponse;
use RAGFlow\Responses\Audio\TranslationResponse;
use RAGFlow\Testing\Resources\Concerns\Testable;

final class AudioTestResource implements AudioContract
{
    use Testable;

    protected function resource(): string
    {
        return Audio::class;
    }

    public function speech(array $parameters): string
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function speechStreamed(array $parameters): SpeechStreamResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function transcribe(array $parameters): TranscriptionResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }

    public function translate(array $parameters): TranslationResponse
    {
        return $this->record(__FUNCTION__, func_get_args());
    }
}
