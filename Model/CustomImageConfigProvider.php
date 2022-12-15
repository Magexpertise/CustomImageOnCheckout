<?php

namespace Magexpertise\CustomImageOnCheckout\Model;

use Magento\Checkout\Model\ConfigProviderInterface;
use Magexpertise\CustomImageOnCheckout\Helper\Data;

class CustomImageConfigProvider implements ConfigProviderInterface
{

    /**
     * @param Data $expertiseHelper
     *
     * @throws LocalizedException
     */
    public function __construct(
        Data $expertiseHelper
    ) {
        $this->expertiseHelper = $expertiseHelper;
    }

    /**
     * @inheritdoc
     */
    public function getConfig()
    {
        $config = [];
        $config['checkout']['custom']['image'] = $this->expertiseHelper->getCustomImage();
        $config['checkout']['custom']['title'] = $this->expertiseHelper->getTitle();

        return $config;
    }
}
