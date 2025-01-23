<?php

declare(strict_types=1);

namespace RAGFlow\Responses\Concerns;

use RAGFlow\Responses\Meta\MetaInformation;

trait HasMetaInformation
{
    public function meta(): MetaInformation
    {
        return $this->meta;
    }
}
