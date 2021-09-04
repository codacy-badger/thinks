<?php

namespace IsaEken\Thinks\Tests;

use IsaEken\Thinks\Cache;
use PHPUnit\Framework\TestCase;

class CacheTest extends TestCase
{
    public Cache|null $cache = null;

    public function getCache(): Cache
    {
        if ($this->cache === null) {
            $this->cache = new Cache;
        }

        return $this->cache;
    }

    public function testInvalidate()
    {
        $this->getCache()->set('test', 'xd');
        $this->assertTrue($this->getCache()->has('test'));
        $this->getCache()->invalidate();
        $this->assertFalse($this->getCache()->has('test'));
    }

    public function testRemember()
    {
        $cache = $this->getCache();

        $this->assertFalse($cache->has('xd'));
        $this->assertEquals($cache->remember('xd', function () {
            return 2 + 5;
        }), 7);
        $this->assertTrue($cache->has('xd'));
        $this->assertEquals($cache->get('xd'), 7);
        $this->assertEquals($cache->remember('xd', function () {
            return 2 + 2;
        }), 7);
        $this->assertEquals($cache->remember('xd', function () {
            return 2 + 2;
        }, true), 4);


        $this->assertEquals($cache->remember('qwerty', ['testing']), ['testing']);
    }
}
