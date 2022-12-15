<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magexpertise\CustomImageOnCheckout\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Magexpertise data helper
 *
 * @api
 * @since 100.0.2
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public const CHECKOUT_CUSTOM_IMAGE = 'expertise/custom/image';
    public const CHECKOUT_CUSTOM_IMAGE_TITLE = 'expertise/custom/title';
    public const DEFAULT_CHECKOUT_CUSTOM_IMAGE_TITLE = 'Custom Image';

    /**
     *
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface  $scopeConfig
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        $this->storeManager = $storeManager;
        $this->scopeConfig    = $scopeConfig;
    }

    /**
     * Get store id
     *
     * @return string
     */
    public function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    /**
     * Get checkout custom image
     *
     * @return string
     */
    public function getCustomImage()
    {
        $relativePathOfImage = $this->scopeConfig->getValue(
            self::CHECKOUT_CUSTOM_IMAGE,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );

        $image = $this->storeManager
            ->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . DIRECTORY_SEPARATOR .
                'magexpertise/custom/logo/'. $relativePathOfImage;

        if ($relativePathOfImage) {
            return $image;
        }

        return false;
    }

    /**
     * Get checkout custom image title
     *
     * @return string
     */
    public function getTitle()
    {
        $title = $this->scopeConfig->getValue(
            self::CHECKOUT_CUSTOM_IMAGE_TITLE,
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );

        if (!$title) {
            $title = self::DEFAULT_CHECKOUT_CUSTOM_IMAGE_TITLE;
        }

        return $title;
    }
}
