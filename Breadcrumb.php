<?php

/*
 * This file is part of the Tadcka package.
 *
 * (c) Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tadcka\Component\Breadcrumbs;

/**
 * @author Tadas Gliaubicas <tadcka89@gmail.com>
 *
 * @since 10/30/14 11:20 PM
 */
class Breadcrumb implements \Iterator, \Countable
{
    /**
     * @var array
     */
    private $items = array();

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return current($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        next($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return key($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return isset($this->items[$this->key()]);
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        reset($this->items);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * Add item.

     * @param string $title
     * @param string $url
     * @param bool $truncate
     */
    public function add($title, $url = null, $truncate = true)
    {
        $this->items[] = array(
            'title' => $truncate ? $this->truncate($title) : $title,
            'url' => $url,
        );
    }

    /**
     * @param int $key
     *
     * @return array|null
     */
    public function get($key)
    {
        return isset($this->items[$key]) ? $this->items[$key] : null;
    }

    /**
     * Truncate string.
     *
     * @param string $string
     * @param int $length
     * @param string $separator
     *
     * @return string
     */
    protected function truncate($string, $length = 30, $separator = '...')
    {
        if (mb_strlen($string) > $length) {

            return rtrim(mb_substr($string, 0, $length)) . $separator;
        }

        return $string;
    }
}
