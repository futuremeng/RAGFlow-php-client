<?php

namespace RAGFlow\Responses;

use Generator;
use RAGFlow\Contracts\ResponseHasMetaInformationContract;
use RAGFlow\Contracts\ResponseStreamContract;
use RAGFlow\Exceptions\ErrorException;
use RAGFlow\Responses\Meta\MetaInformation;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @template TResponse
 *
 * @implements ResponseStreamContract<TResponse>
 */
final class StreamResponse implements ResponseHasMetaInformationContract, ResponseStreamContract
{
    /**
     * Creates a new Stream Response instance.
     *
     * @param  class-string<TResponse>  $responseClass
     */
    public function __construct(
        private readonly string $responseClass,
        private readonly ResponseInterface $response,
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator(): Generator
    {
        while (! $this->response->getBody()->eof()) {
            $line = $this->readLine($this->response->getBody());

            // data:{
            //     "code": 0,
            //     "data": {
            //         "answer": "I am an intelligent assistant designed to help answer questions by summarizing content from a",
            //         "reference": {},
            //         "audio_binary": null,
            //         "id": "a84c5dd4-97b4-4624-8c3b-974012c8000d",
            //         "session_id": "82b0ab2a9c1911ef9d870242ac120006"
            //     }
            // }

            $event = null;
            if (str_starts_with($line, 'event:')) {
                $event = trim(substr($line, strlen('event:')));
                $line = $this->readLine($this->response->getBody());
            }

            if (! str_starts_with($line, 'data:')) {
                continue;
            }

            $data = trim(substr($line, strlen('data:')));

            

            /** @var array{error?: array{message: string|array<int, string>, type: string, code: string}} $response */
            $response = json_decode($data, true, flags: JSON_THROW_ON_ERROR);


            // ragflow返回的流数据，最后一行是结束标记
            // data:{
            //     "code": 0,
            //     "message": "",
            //     "data": true
            // }
            if ($response['data']===true) {
                break;
            }

            if (isset($response['error'])) {
                throw new ErrorException($response['error'], $this->response->getStatusCode());
            }

            if ($event !== null) {
                $response['__event'] = $event;
                $response['__meta'] = $this->meta();
            }

            yield $this->responseClass::from($response);
        }
    }

    /**
     * Read a line from the stream.
     */
    private function readLine(StreamInterface $stream): string
    {
        $buffer = '';

        while (! $stream->eof()) {
            if ('' === ($byte = $stream->read(1))) {
                return $buffer;
            }
            $buffer .= $byte;
            if ($byte === "\n") {
                break;
            }
        }

        return $buffer;
    }

    public function meta(): MetaInformation
    {
        // @phpstan-ignore-next-line
        return MetaInformation::from($this->response->getHeaders());
    }
}
