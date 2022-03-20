<?php
/*
 * Copyright (c) Shaymaa Saied  08/06/2021, 10:05.
 */

namespace MageArab\CustomerAddress\Observer\Adminhtml;
use Magento\Framework\Event\ObserverInterface;

class CopyCustomAddressAttributes implements ObserverInterface
{
    protected $objectCopyService;
    public function __construct(
        \Magento\Framework\DataObject\Copy $objectCopyService
    ) {
        $this->objectCopyService = $objectCopyService;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $model=$observer->getOrderCreateModel();
        $quote = $model->getQuote();

        $billingAddress=$quote->getBillingAddress();
        $shippingAddress=$quote->getShippingAddress();
        $shippingAddressExtensionAttributes = $shippingAddress->getExtensionAttributes();
        if ($shippingAddressExtensionAttributes) {
            $shippingAddressExtensionAttributes->setLongitude($shippingAddress->getLongitude());
            $shippingAddressExtensionAttributes->setLatitude($shippingAddress->getLatitude());
            $shippingAddress->setExtensionAttributes($shippingAddressExtensionAttributes);
        }
        $billingAddressExtensionAttributes = $billingAddress->getExtensionAttributes();
        if ($billingAddressExtensionAttributes) {
            $billingAddressExtensionAttributes->setLongitude($billingAddress->getLongitude());
            $billingAddressExtensionAttributes->setLatitude($billingAddress->getLatitude());
            $billingAddress->setExtensionAttributes($billingAddressExtensionAttributes);
        }


        $quote->setBillingAddress($billingAddress);
        $quote->setShippingAddress($shippingAddress);
        $model->setQuote($quote);
        /*var_dump($model->getQuote()->getBillingAddress()->getExtensionAttributes());
        exit();*/
        return $this;
    }
}