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
namespace Lof\Opengraph\Plugin\Cms\Model\Page\DataProvider;

class AfterCmsEditDataProvider
{
    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var \Lof\Opengraph\Service\Admin\CmsImageDataProvider
     */
    protected $cmsImageDataProvider;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Lof\Opengraph\Service\Admin\CmsImageDataProvider $cmsImageDataProvider
    ) {
        $this->request = $request;
        $this->cmsImageDataProvider = $cmsImageDataProvider;
    }

    public function afterGetData(\Magento\Cms\Model\Page\DataProvider $subject, $result)
    {
        if (!$result) {
            return $result;
        }

        $currentPageId = $this->request->getParam('page_id', 0);

        if (!$currentPageId || !isset($result[$currentPageId])) {
            return $result;
        }

        $pageData = $result[$currentPageId];

        if (!isset($pageData['og_image'])) {
            return $result;
        }

        $imageDataArray = $this->cmsImageDataProvider->getImageData($pageData['og_image'], \Lof\Opengraph\Service\CmsImageUrlProvider::OPENGRAPH_CMS_IMAGE_PATH);

        $result[$pageData['page_id']]['og_image'] = $imageDataArray;

        return $result;
    }
}
