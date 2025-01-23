<?php

namespace RAGFlow\Enums\FineTuning;

enum FineTuningEventLevel: string
{
    case Info = 'info';
    case Warning = 'warn';
    case Error = 'error';
}
