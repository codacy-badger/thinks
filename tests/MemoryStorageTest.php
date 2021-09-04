<?php

namespace IsaEken\Thinks\Tests;

use IsaEken\Thinks\MemoryStorage;
use PHPUnit\Framework\TestCase;

class MemoryStorageTest extends TestCase
{
    public function test()
    {
        $storage = new MemoryStorage([
            'testing' => 123,
            'heyy' => 'yoo',
        ]);

        $this->assertEquals($storage->getKeys(), ['testing', 'heyy']);
        $this->assertEquals($storage->getValues(), [123, 'yoo']);

        $this->assertTrue($storage->has('testing'));
        $this->assertFalse($storage->has('xd'));

        $this->assertEquals($storage->get('heyy'), 'yoo');
        $storage->set('heyy', 'xd');
        $storage->set('xd', 'heyy');
        $this->assertTrue($storage->has('xd'));
        $this->assertEquals($storage->get('heyy'), 'xd');

        $storage->remove('heyy');
        $this->assertFalse($storage->has('heyy'));
    }
}
