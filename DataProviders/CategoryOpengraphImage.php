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

class CategoryOpengraphImage extends TagProvider implements TagProviderInterface
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Lof\Opengraph\Factory\TagFactoryInterface
     */
    protected $tagFactory;

    /**
     * @var \Lof\Opengraph\Helper\Mime
     */
    protected $mimeHelper;

    protected $tags = [];

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Lof\Opengraph\Factory\TagFactoryInterface $tagFactory,
        \Lof\Opengraph\Helper\Mime $mimeHelper

    ) {
        $this->registry = $registry;
        $this->tagFactory = $tagFactory;
        $this->mimeHelper = $mimeHelper;
    }

    public function getTags()
    {
        $category = $this->registry->registry('current_category');

        if(!$category or !$category->getId()){
            return [];
        }

        $this->addImageTag();

        return $this->tags;
    }

    private function addImageTag()
    {
        $category = $this->registry->registry('current_category');

        $opengraphImage = $category->getOgImage() ?? null;

        if(!$opengraphImage){
            return;
        }

        $imageUrl = $category->getImageUrl('og_image');

        if(!$imageUrl){
            return;
        }

        $tag = $this->tagFactory->getTag('image', $imageUrl);
        $this->addTag($tag);

        $mimeType = $this->mimeHelper->getMimeType($imageUrl);

        if($mimeType){
            $tag = $this->tagFactory->getTag('image:type', $mimeType);
            $this->addTag($tag);
        }

        $categoryData = array_filter($category->getData());
        $title = $categoryData['og_title'] ?? $categoryData['meta_title'] ?? $categoryData['name'] ?? null;

        if($title){
            $tag = $this->tagFactory->getTag('image:alt', $title);
            $this->addTag($tag);
        }

        return;
    }
}