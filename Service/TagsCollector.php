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
namespace Lof\Opengraph\Service;

class TagsCollector
{
    /**
     * @var array
     */
    protected $dataProviders;

    public function __construct(array $dataProviders)
    {
        $this->dataProviders = $dataProviders;
    }

    public function getTags($pageType = null)
    {
        if (empty($pageType) || !isset($this->dataProviders[$pageType])) {
            $pageType = \Lof\Opengraph\Helper\PageType::DEFAULT_PAGE_TYPE;
        }
        
        $dataProviders = $this->sortProviders($this->dataProviders[$pageType]);

        $tags = [];

        foreach ($dataProviders as $dataProvider) {
            $dataProviderClass = $dataProvider['class'];

            if (!is_object($dataProviderClass) || !$dataProviderClass instanceof \Lof\Opengraph\DataProviders\TagProviderInterface) {
                continue;
            }

            $tags = $this->mergeTags($tags, $dataProviderClass->getTags());
        }

        return $tags;
    }

    protected function sortProviders($dataProviders)
    {
        usort($dataProviders, function ($a, $b) {
            $aSortOrder = $a['sortOrder'] ?? 0;
            $bSortOrder = $b['sortOrder'] ?? 0;

            return ($aSortOrder <=> $bSortOrder);
        });

        return $dataProviders;
    }

    protected function mergeTags($currentTags, $newTags)
    {
        if (empty($currentTags)) {
            return $newTags;
        }

        return array_replace($currentTags, $newTags);
    }
}
