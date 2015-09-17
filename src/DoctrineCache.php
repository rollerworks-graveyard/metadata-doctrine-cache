<?php

/*
 * This file is part of the Rollerworks Metadata Component package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Component\Metadata\Cache;

use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\ClearableCache;
use Rollerworks\Component\Metadata\ClassMetadata;

final class DoctrineCache implements ClearableCacheProvider
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Fetches a class metadata instance from the cache.
     *
     * @param string $key
     *
     * @return ClassMetadata|null
     */
    public function fetch($key)
    {
        $data = $this->cache->fetch($key);

        return false === $data ? null : $data;
    }

    /**
     * Tests if a class metadata entry exists in the cache.
     *
     * @param string $key
     *
     * @return bool
     */
    public function contains($key)
    {
        return $this->cache->contains($key);
    }

    /**
     * Puts the class metadata into the cache.
     *
     * @param string        $key
     * @param ClassMetadata $metadata
     */
    public function save($key, ClassMetadata $metadata)
    {
        $this->cache->save($key, $metadata);
    }

    /**
     * Deletes a cached class metadata entry.
     *
     * @param string $key
     */
    public function delete($key)
    {
        $this->cache->delete($key);
    }

    /**
     * Delete (clear) all the currently cached metadata.
     */
    public function clearAll()
    {
        if ($this->cache instanceof ClearableCache) {
            $this->cache->deleteAll();
        }
    }
}
