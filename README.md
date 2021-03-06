# websocket-common
Base stream interfaces for client and server websocket implementations
# Installation
This package can be installed as a Composer dependency.

`composer require ekstazi/websocket-common`
# Requirements
PHP 7.2+
# Interfaces
Three interfaces provided
## `interface Reader extends InputStream`
### Methods
#### `read(): Promise<string>`
Reads data from the stream. Return `Promise` that resolves with a string when new data is available or `null` if the stream has closed.

## `interface Writer extends OutputStream`
### Constants
#### `const MODE_BINARY = "binary"`
Send data as binary frames. This mode used by default.
#### `const MODE_TEXT = 'text'`
Send data as utf-8 text frames.
### Methods
#### `public function setDefaultMode(string $mode): void`
Set default mode to write frames.
#### `public function getDefaultMode(): string`
Get current default write mode.
#### `public function write(string $data, string $mode = null): Promise<int>`
Write data with specified write mode. By default value  `Writer::getMode()` used. Return promise that resolves with number of bytes written
#### `public function end(string $finalData = "", string $mode = null): Promise`
Marks the stream as no longer writable. Optionally writes a final data chunk before. Note that this is not the
same as forcefully closing the stream. This method waits for all pending writes to complete before closing the
stream. Socket streams implementing this interface should only close the writable side of the stream.

## `interface Connection extends Reader, Writer`
