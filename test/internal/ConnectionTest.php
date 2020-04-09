<?php

namespace ekstazi\websocket\common\test\internal;

use Amp\PHPUnit\AsyncTestCase;
use Amp\Success;
use ekstazi\websocket\common\internal\Connection;
use ekstazi\websocket\common\Reader;
use ekstazi\websocket\common\Writer;

/**
 * @internal
 * Class ConnectionTest
 * @package ekstazi\websocket\common\test\internal
 */
class ConnectionTest extends AsyncTestCase
{
    private function createConnection(Reader $reader, Writer $writer)
    {
        return new class($reader, $writer) extends Connection {
        };
    }

    public function testConstruct()
    {
        $reader = $this->createStub(Reader::class);
        $writer = $this->createStub(Writer::class);

        $client = $this->createConnection($reader, $writer);

        self::assertInstanceOf(Reader::class, $client);
        self::assertInstanceOf(Writer::class, $client);
    }

    public function testEnd()
    {
        $reader = $this->createStub(Reader::class);

        $writer = $this->createMock(Writer::class);
        $writer->expects(self::once())
            ->method('end')
            ->with('test')
            ->willReturn(new Success());

        $stream = $this->createConnection($reader, $writer);
        yield $stream->end('test');
    }

    public function testRead()
    {
        $reader = $this->createMock(Reader::class);
        $reader->expects(self::once())
            ->method('read')
            ->willReturn(new Success('test'));

        $writer = $this->createStub(Writer::class);

        $stream = $this->createConnection($reader, $writer);
        $data = yield $stream->read();

        self::assertEquals('test', $data);
    }

    public function testWrite()
    {
        $reader = $this->createStub(Reader::class);

        $writer = $this->createMock(Writer::class);
        $writer->expects(self::once())
            ->method('write')
            ->with('test')
            ->willReturn(new Success());

        $stream = $this->createConnection($reader, $writer);
        yield $stream->write('test');
    }

    public function testSetDefaultMode()
    {
        $reader = $this->createStub(Reader::class);

        $writer = $this->createMock(Writer::class);
        $writer->expects(self::once())
            ->method('setDefaultMode')
            ->with(Writer::MODE_TEXT);

        $stream = $this->createConnection($reader, $writer);
        $stream->setDefaultMode(Writer::MODE_TEXT);
    }

    public function testGetDefaultMode()
    {
        $reader = $this->createStub(Reader::class);

        $writer = $this->createMock(Writer::class);
        $writer->expects(self::once())
            ->method('getDefaultMode')
            ->willReturn(Writer::MODE_TEXT);

        $connection = $this->createConnection($reader, $writer);
        self::assertEquals(Writer::MODE_TEXT, $connection->getDefaultMode());
    }
}
