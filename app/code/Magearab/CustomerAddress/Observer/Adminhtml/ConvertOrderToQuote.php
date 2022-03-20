<?php
/*
 * Copyright (c) Shaymaa Saied  08/06/2021, 12:24.
 */

namespace MageArab\CustomerAddress\Observer\Adminhtml;

use Magento\Framework\Event\ObserverInterface;

class ConvertOrderToQuote implements ObserverInterface
{
    protected $_objectCopyService;

    public function __construct(
        \Magento\Framework\DataObject\Copy $objectCopyService
    ) {
        $this->_objectCopyService = $objectCopyService;
    }

    public function execute(
        \Magento\Framework\Event\Observer $observer
    )
    {
        $order = $observer->getEvent()->getData('order');
        $quote = $observer->getEvent()->getData('quote');
        $shippingAddress = $quote->getShippingAddress();
        $shippingAddressExtensionAttributes = $shippingAddress->getExtensionAttributes();
        if ($shippingAddressExtensionAttributes) {
            $longitude = $shippingAddressExtensionAttributes->getLongitude();
            $shippingAddress->setLongitude($longitude);
            $latitude = $shippingAddressExtensionAttributes->getLatitude();
            $shippingAddress->setLatitude($latitude);
        }
        $billingAddress = $quote->getBillingAddress();
        $billingAddressExtensionAttributes = $billingAddress->getExtensionAttributes();
        if ($billingAddressExtensionAttributes) {
            $longitude = $billingAddressExtensionAttributes->getLongitude();
            $billingAddress->setLongitude($longitude);
            $latitude = $billingAddressExtensionAttributes->getLatitude();
            $billingAddress->setLatitude($latitude);
        }
        /*var_dump($quote->getBillingAddress()->getData());
        exit();*/

        return $this;
    }
}