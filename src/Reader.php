<?php

namespace ekstazi\websocket\common;

use Amp\ByteStream\ClosedException;
use Amp\ByteStream\InputStream;
use Amp\Promise;

interface Reader extends InputStream
{

    /**
     * @inheritDoc
     * @throws ClosedException Thrown if the connection is closed.
     */
    public function read(): Promise;
}
