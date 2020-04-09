<?php

namespace ekstazi\websocket\common\test\internal;

use ekstazi\websocket\common\internal\SetModeTrait;
use ekstazi\websocket\common\Writer;
use PHPUnit\Framework\TestCase;

class SetModeTest extends TestCase
{
    private function createInstance()
    {
        return new class() {
            use SetModeTrait;
        };
    }

    public function testValidMode()
    {
        $instance = $this->createInstance();
        $instance->setDefaultMode(Writer::MODE_TEXT);
        self::assertEquals(Writer::MODE_TEXT, $instance->getDefaultMode());

        $instance->setDefaultMode(Writer::MODE_BINARY);
        self::assertEquals(Writer::MODE_BINARY, $instance->getDefaultMode());
    }

    public function testInvalidMode()
    {
        $instance = $this->createInstance();
        $this->expectException(\InvalidArgumentException::class);
        $instance->setDefaultMode('test');
    }
}
