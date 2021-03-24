<?php

namespace Lof\Opengraph\Factory;

class TagFactory implements TagFactoryInterface
{
    /**
     * @var \Lof\Opengraph\Model\TagFactory
     */
    protected $tagFactory;

    public function __construct(\Lof\Opengraph\Model\TagFactory $tagFactory)
    {
        $this->tagFactory = $tagFactory;
    }

    public function getTag($name, $value, $addEvenIfValueIsEmpty = false)
    {
        $tag = $this->tagFactory->create();

        if (empty($name)) {
            return $tag;
        }

        if (!$addEvenIfValueIsEmpty && !$value) {
            return $tag;
        }

        $tag->setName($name);
        $tag->setValue($value);

        return $tag;
    }
}
