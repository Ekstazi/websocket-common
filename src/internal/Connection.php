<?php

namespace ekstazi\websocket\common\internal;

use Amp\Promise;
use ekstazi\websocket\common\Reader;
use ekstazi\websocket\common\Writer;

/**
 * Base connection class. Do not use this class in your code. Use concrete implementation instead.
 * @internal
 * @package ekstazi\websocket\common\internal
 */
abstract class Connection implements Reader, Writer
{
    /**
     * @var Reader
     */
    private $reader;
    /**
     * @var Writer
     */
    private $writer;

    public function __construct(Reader $reader, Writer $writer)
    {
        $this->reader = $reader;
        $this->writer = $writer;
    }

    public function read(): Promise
    {
        return $this->reader->read();
    }

    public function setDefaultMode(string $defaultMode): void
    {
        $this->writer->setDefaultMode($defaultMode);
    }

    public function getDefaultMode(): string
    {
        return $this->writer->getDefaultMode();
    }

    public function write(string $data, string $mode = null): Promise
    {
        return $this->writer->write($data, $mode);
    }

    public function end(string $finalData = "", string $mode = null): Promise
    {
        return $this->writer->end($finalData, $mode);
    }
}
