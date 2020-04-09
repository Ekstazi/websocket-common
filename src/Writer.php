<?php

namespace ekstazi\websocket\common;

use Amp\ByteStream\ClosedException;
use Amp\ByteStream\OutputStream;
use Amp\Promise;

interface Writer extends OutputStream
{
    /**
     * Send data as binary frames. Used by default.
     */
    const MODE_BINARY = "binary";

    /**
     * Send data as utf-8 text frames.
     */
    const MODE_TEXT = 'text';

    /**
     * Set default mode to write frames.
     * @param string $mode
     * @throws \InvalidArgumentException if unknown mode is passed
     */
    public function setMode(string $mode): void;

    /**
     * Get current default write mode.
     * @return string
     */
    public function getMode(): string;

    /**
     * @inheritDoc
     * @param string $data Payload to send.
     * @param string $mode Mode to send frame binary or text. . If no specified then default mode is used.
     *
     * @return Promise<int> Resolves with the number of bytes sent to the other endpoint.
     * @throws ClosedException Thrown if sending to the client fails.
     */
    public function write(string $data, string $mode = null): Promise;

    /**
     * @inheritDoc
     *
     * @param string $finalData Bytes to write.
     * @param string $mode Mode to send final data binary or text. If no specified then default mode is used.
     *
     * @return Promise<int> Succeeds once the data has been successfully written to the stream.
     */
    public function end(string $finalData = "", string $mode = null): Promise;
}
