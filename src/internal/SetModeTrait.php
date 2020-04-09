<?php

namespace ekstazi\websocket\common\internal;

use ekstazi\websocket\common\Writer;

/**
 * This trait used to implement write modes in writer.
 * @internal
 * @package ekstazi\websocket\common\internal
 */
trait SetModeTrait
{
    private $defaultMode;

    public function setDefaultMode(string $defaultMode)
    {
        $this->guardValidMode($defaultMode);
        $this->defaultMode = $defaultMode;
    }

    public function getDefaultMode(): string
    {
        return $this->defaultMode;
    }

    private function guardValidMode(string $mode)
    {
        if (!\in_array($mode, [Writer::MODE_BINARY, Writer::MODE_TEXT])) {
            throw new \InvalidArgumentException('Unknown mode passed: '. $mode);
        }
    }
}
