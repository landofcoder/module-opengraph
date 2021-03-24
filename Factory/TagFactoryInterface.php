<?php

namespace Lof\Opengraph\Factory;

interface TagFactoryInterface
{

    /**
     * Returns Tag object
     *
     * @param string $name
     * @param string $value
     * @param bool $addEvenIfValueIsEmpty
     * @return \Lof\Opengraph\Model\Tag|null
     */
    public function getTag($name, $value, $addEvenIfValueIsEmpty = false);
}
