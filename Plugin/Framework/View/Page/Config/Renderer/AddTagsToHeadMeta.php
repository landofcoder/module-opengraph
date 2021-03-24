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
namespace Lof\Opengraph\Plugin\Framework\View\Page\Config\Renderer;

class AddTagsToHeadMeta
{
    /**
     * @var \Magento\Framework\View\Page\Config
     */
    protected $pageConfig;

    /**
     * @var \Lof\Opengraph\Helper\Configuration
     */
    protected $configuration;

    /**
     * @var \Lof\Opengraph\Helper\PageType
     */
    protected $pageType;

    /**
     * @var \Lof\Opengraph\Service\TagsCollector
     */
    protected $tagsCollector;

    public function __construct(
        \Magento\Framework\View\Page\Config $pageConfig,
        \Lof\Opengraph\Helper\Configuration $configuration,
        \Lof\Opengraph\Helper\PageType $pageType,
        \Lof\Opengraph\Service\TagsCollector $tagsCollector
    ) {
        $this->pageConfig = $pageConfig;
        $this->configuration = $configuration;
        $this->pageType = $pageType;
        $this->tagsCollector = $tagsCollector;
    }

    public function afterRenderMetadata(\Magento\Framework\View\Page\Config\Renderer $subject, $result)
    {
        if (!$this->configuration->isEnabled()) {
            return $result;
        }

        $pageType = $this->pageType->getPageType();
        $isEnabledForPage = true;
        switch($pageType){
            case "cms":
                if(!$this->configuration->isEnabledForPage()){
                    $isEnabledForPage = false;
                }
                break;
            case "category":
                if(!$this->configuration->isEnabledForCategory()){
                    $isEnabledForPage = false;
                }
                break;
            case "product":
                if(!$this->configuration->isEnabledForProduct()){
                    $isEnabledForPage = false;
                }
                break;
            case "default":
            default:
                if(!$this->configuration->isEnabledForWebsite()){
                    $isEnabledForPage = false;
                }
            break;
        }
        if(!$isEnabledForPage){
            return $result;
        }
        $tags = $this->tagsCollector->getTags($pageType);

        if (empty($tags)) {
            return $result;
        }

        foreach ($tags as $name => $value) {
            if (empty($value)) {
                continue;
            }

            $metadataTemplate = $this->getMetadataTemplate($name);

            $value = strip_tags($value);

            $result .= str_replace(['%name', '%content'], [$name, $value], $metadataTemplate);
        }

        return $result;
    }

    protected function getMetadataTemplate($name)
    {
        return '<meta property="' . $name . '" content="%content"/>' . "\n";
    }
}
