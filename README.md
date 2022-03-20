# Custom Address Attributes (longitude, latitude)

### Features
- Add custom attributes to customer address 
- Save custom address attributes to customer quote
- Save this attributes to order  
- Edit this when edit order address on backend

## Installation

Copy the content of the repo to the app/code/Magearab/CustomerAddress/ folder

Enable module:
```
php bin/magento module:enable MageArab_CustomerAddress
```

Disable module: (Optional)
```
php bin/magento module:disable MageArab_CustomerAddress --clear-static-content
```

Update system:
```
php bin/magento setup:upgrade
php bin/magento setup:di:compile
php bin/magento cache:flush
php bin/magento cache:clean
```
