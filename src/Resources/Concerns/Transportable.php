<?php

declare(strict_types=1);

namespace RAGFlow\Resources\Concerns;

use RAGFlow\Contracts\TransporterContract;

trait Transportable
{
    public function __construct(private readonly TransporterContract $transporter)
    {
        // ..
    }
}
