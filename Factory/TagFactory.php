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
