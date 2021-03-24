<?php

namespace Lof\Opengraph\DataProviders;

class TagProvider implements TagProviderInterface
{
    protected $tags = [];

    public function getTags()
    {
        return $this->tags;
    }

    protected function addTag(\Lof\Opengraph\Model\Tag $tag)
    {
        if (!$tag->getName()) {
            return;
        }

        $this->tags[$tag->getOpengraphName()] = $tag->getValue();
    }

    protected function addProductTag(\Lof\Opengraph\Model\Tag $tag)
    {
        if (!$tag->getName()) {
            return;
        }

        $this->tags[$tag->getOpengraphProductName()] = $tag->getValue();
    }
}
