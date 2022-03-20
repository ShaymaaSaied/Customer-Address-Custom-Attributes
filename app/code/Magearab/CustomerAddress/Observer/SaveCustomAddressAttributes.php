<?php
/*
 * Copyright (c) Shaymaa Saied  07/06/2021, 10:09.
 */

namespace MageArab\CustomerAddress\Observer;


use Magento\Framework\Event\Observer as EventObserver;

class SaveCustomAddressAttributes implements \Magento\Framework\Event\ObserverInterface
{
    protected $_objectManager;

    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectmanager
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager
    )
    {
        $this->_objectManager = $objectManager;
    }

    public function execute(EventObserver $observer)
    {
        $order = $observer->getOrder();
        $quoteRepository = $this->_objectManager->create('Magento\Quote\Model\QuoteRepository');
        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $quoteRepository->get($order->getQuoteId());
        $billingAddress=$quote->getBillingAddress();

        $shippingAddress=$quote->getShippingAddress();
        /*var_dump($billingAddress->getData());
        exit();*/
        $orderShipping=$order->getShippingAddress();
        $orderBilling=$order->getBillingAddress();
        $orderShipping->setLongitude($shippingAddress->getData('longitude'));
        $orderShipping->setLatitude($shippingAddress->getData('latitude'));
        $orderBilling->setLongitude($billingAddress->getData('longitude'));
        $orderBilling->setLatitude($billingAddress->getData('latitude'));
        $order->setBillingAddress($orderBilling);
        $order->setShippingAddress($orderShipping);

        return $this;
    }
}