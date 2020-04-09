<?php

namespace ekstazi\websocket\common;

interface Connection extends Reader, Writer
{
    /**
     * @return int Unique identifier for the client.
     */
    public function getId(): int;

    /**
     * @return string Remote socket address.
     */
    public function getRemoteAddress(): string;
}
