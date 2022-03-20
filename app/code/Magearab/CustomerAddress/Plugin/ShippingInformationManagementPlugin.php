<?php
/*
 * Copyright (c) Shaymaa Saied  05/06/2021, 01:12.
 */

namespace MageArab\CustomerAddress\Plugin;


class ShippingInformationManagementPlugin
{
    protected $_quoteRepository;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->_quoteRepository = $quoteRepository;
    }
    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $shippingAddress = $addressInformation->getShippingAddress();
        $shippingAddressExtensionAttributes = $shippingAddress->getExtensionAttributes();
        if ($shippingAddressExtensionAttributes) {
            $longitude = $shippingAddressExtensionAttributes->getLongitude();
            $shippingAddress->setLongitude($longitude);
            $latitude = $shippingAddressExtensionAttributes->getLatitude();
            $shippingAddress->setLatitude($latitude);
        }
        $billingAddress = $addressInformation->getBillingAddress();
        $billingAddressExtensionAttributes = $billingAddress->getExtensionAttributes();
        if ($billingAddressExtensionAttributes) {
            $longitude = $billingAddressExtensionAttributes->getLongitude();
            $billingAddress->setLongitude($longitude);
            $latitude = $billingAddressExtensionAttributes->getLatitude();
            $billingAddress->setLatitude($latitude);
        }

    }

}
