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

class Category extends TagProvider implements TagProviderInterface
{
    const DEFAULT_CATEGORY_OPENGRAPH_TYPE = 'website';

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var \Magento\UrlRewrite\Model\UrlFinderInterface
     */
    protected $urlFinder;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Lof\Opengraph\Factory\TagFactoryInterface
     */
    protected $tagFactory;

    protected $tags = [];

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\UrlRewrite\Model\UrlFinderInterface $urlFinder,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Lof\Opengraph\Factory\TagFactoryInterface $tagFactory

    ) {
        $this->registry = $registry;
        $this->request = $request;
        $this->urlFinder = $urlFinder;
        $this->storeManager = $storeManager;
        $this->tagFactory = $tagFactory;
    }

    public function getTags()
    {
        $category = $this->registry->registry('current_category');

        if (!$category || !$category->getId()) {
            return [];
        }

        $this->addTitleTag($category);
        $this->addDescriptionTag($category);
        $this->addTypeTag($category);
        $this->addUrlTag();

        return $this->tags;
    }

    private function addTitleTag($category)
    {
        $title = $category->getData('og_title');

        if (empty($title)) {
            $categoryData = array_filter($category->getData());
            $title = $categoryData['meta_title'] ?? $categoryData['name'] ?? null;
        }

        if (!$title) {
            return;
        }

        $tag = $this->tagFactory->getTag('title', $title);

        $this->addTag($tag);
    }

    private function addDescriptionTag($category)
    {
        $description = $category->getData('og_description');

        if (empty($description)) {
            $categoryData = array_filter($category->getData());
            $description = $categoryData['og_description'] ?? $categoryData['meta_description'] ?? $categoryData['description'] ?? null;
        }

        if (!$description) {
            return;
        }

        $tag = $this->tagFactory->getTag('description', $description);

        $this->addTag($tag);
    }

    private function addTypeTag($category)
    {
        $categoryData = array_filter($category->getData());

        $type = $categoryData['og_type'] ?? self::DEFAULT_CATEGORY_OPENGRAPH_TYPE;

        $tag = $this->tagFactory->getTag('type', $type);

        $this->addTag($tag);
    }

    private function addUrlTag()
    {
        $urlRewrite = $this->urlFinder->findOneByData([
            'target_path' => trim($this->request->getPathInfo(), '/'),
            'store_id' => $this->storeManager->getStore()->getId()
        ]);

        if (!$urlRewrite) {
            return;
        }

        $currentUrl = $this->storeManager->getStore()->getBaseUrl() . $urlRewrite->getRequestPath();

        $tag = $this->tagFactory->getTag('url', $currentUrl);

        $this->addTag($tag);
    }
}