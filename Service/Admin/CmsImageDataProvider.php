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
namespace Lof\Opengraph\Service\Admin;

class CmsImageDataProvider
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Lof\Opengraph\Service\CmsImageUrlProvider
     */
    protected $cmsImageUrlProvider;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Lof\Opengraph\Service\CmsImageUrlProvider $cmsImageUrlProvider
    )
    {
        $this->storeManager = $storeManager;
        $this->cmsImageUrlProvider = $cmsImageUrlProvider;
    }

    /**
     * @param string $imageName
     * @param string $path
     * @return array
     */
    public function getImageData($imageName, $path)
    {
        if(is_array($imageName)){
            $imageName = $imageName[0]['name'] ?? null;
        }

        if(empty($imageName)){
            return [];
        }

        $url = $this->cmsImageUrlProvider->getImageUrl($imageName, $path);

        $path = 'media/' . $path . $imageName;
        $size = file_exists($path) ? filesize($path) : 0;

        $imageData = [
            [
                'url' => $url,
                'name' => $imageName,
                'size' => $size
            ]
        ];

        return $imageData;
    }

}