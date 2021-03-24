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
namespace Lof\Opengraph\Service\Processor;

class UploadImage
{
    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $uploaderFactory;

    /**
     * @var \Magento\Framework\App\Filesystem\DirectoryList
     */
    protected $directoryList;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Lof\Opengraph\Service\CmsImageUrlProvider
     */
    protected $cmsImageUrlProvider;


    public function __construct(
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\App\Filesystem\DirectoryList $directoryList,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Lof\Opengraph\Service\CmsImageUrlProvider $cmsImageUrlProvider
    )
    {
        $this->uploaderFactory = $uploaderFactory;
        $this->directoryList = $directoryList;
        $this->filesystem = $filesystem;
        $this->storeManager = $storeManager;
        $this->cmsImageUrlProvider = $cmsImageUrlProvider;
    }

    public function processUpload($imageName, $path)
    {
        if(!isset($_FILES) && !$_FILES[$imageName]['name']) {
            $result = ['error' => __('Image file has been not uploaded'), 'errorcode' => __('Image file has been not uploaded')];
            return $result;
        }

        $imageFieldName = array_keys($_FILES);

        $uploader = $this->uploaderFactory->create(['fileId' => $imageFieldName[0]]);
        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'svg']);
        $uploader->setAllowRenameFiles(false);
        $uploader->setFilesDispersion(false);

        $path = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)
            ->getAbsolutePath($path);

        $result = $uploader->save($path);

        $imagePath = $uploader->getUploadedFileName();


        if (!$result) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('File can not be saved to the destination folder.')
            );
        }

        $result['tmp_name'] = str_replace('\\', '/', $result['tmp_name']);
        $result['path'] = str_replace('\\', '/', $result['path']);
        $result['url'] = $this->cmsImageUrlProvider->getImageUrl($imagePath, $path);
        $result['name'] = $result['file'];

        return $result;
    }
}