<?php
/**
 * Landofcoder
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/license
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Landofcoder
 * @package    Lof_Opengraph
 * @copyright  Copyright (c) 2021 Landofcoder (https://landofcoder.com/)
 * @license    https://landofcoder.com/LICENSE-1.0.html
 */
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
