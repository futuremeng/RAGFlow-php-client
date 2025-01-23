<?php

declare(strict_types=1);

namespace RAGFlow\Contracts;

use RAGFlow\Responses\Meta\MetaInformation;

interface ResponseHasMetaInformationContract
{
    public function meta(): MetaInformation;
}
