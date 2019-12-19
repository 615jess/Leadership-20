<?php header("Location: /"); exit(); ?>
/********************* Authorize.net log file *********************/
2014-02-20 15:36:15 - INFO  --> Activating/Installing plugin 
2014-02-20 15:36:15 - INFO  --> Creating table: lder_authnet_user_subscription 
2014-02-20 15:36:15 - DEBUG --> CREATE TABLE  `lder_authnet_user_subscription` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `user_id` bigint unsigned NOT NULL,
  `subscription_id` int(10) unsigned NULL,
  `billingFirstName` varchar(255) NOT NULL,
  `billingLastName` varchar(255) NOT NULL,
  `billingCompany` varchar(255) NOT NULL,
  `billingAddress` varchar(255) NOT NULL,
  `billingCity` varchar(255) NOT NULL,
  `billingState` varchar(255) NOT NULL,
  `billingZip` varchar(45) NOT NULL,
  `billingCountry` varchar(255) NOT NULL default 'United States',
  `billingPhone` varchar(45) NOT NULL,
  `shippingFirstName` varchar(255) NULL,
  `shippingLastName` varchar(255) NULL,
  `shippingCompany` varchar(255) NULL,
  `shippingAddress` varchar(255) NULL,
  `shippingCity` varchar(255) NULL,
  `shippingState` varchar(255) NULL,
  `shippingZip` varchar(45) NULL,
  `shippingCountry` varchar(255) NULL default 'United States',
  `shippingPhone` varchar(45) NULL,
  `emailAddress` varchar(255) NOT NULL,
  `xSubscriptionId` varchar(255) NULL,
  `lastFourDigitsOfCreditCard` char(4) NULL,
  `startDate` datetime NULL,
  `MWXAccountLinked` datetime NULL,
  `isRecurring` int(10) NULL,
  `endRecurringDate` datetime NULL,
  `subscriptionNotes` TEXT NULL,
  PRIMARY KEY  USING BTREE (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 COMMENT='this table corresponds to user in wordpress'; 
2014-02-20 15:36:15 - INFO  --> Creating table: lder_authnet_subscription 
2014-02-20 15:36:15 - DEBUG --> CREATE TABLE  `lder_authnet_subscription` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `processSinglePayment` int(10) unsigned NOT NULL ,
  `processRecurringPayment` int(10) unsigned NOT NULL ,
  `name` varchar(255) NOT NULL,
  `initialAmount` decimal(10,2) NULL,
  `initialDescription` varchar(255) NULL,
  `initialInvoiceNum` varchar(255) NULL,
  `recurringRefId` varchar(255) NULL,
  `recurringIntervalLength` int(10) unsigned NULL ,
  `recurringIntervalUnit` varchar(255) NULL,
  `recurringTotalOccurrences` int(10) unsigned NULL ,
  `recurringTrialOccurrences` int(10) unsigned NULL ,
  `recurringConcealTrial` int(10) unsigned NULL ,
  `recurringAmount` decimal(10,2) NULL,
  `recurringTrialAmount` decimal(10,2) NULL,
  `wishlistLevel` varchar(255) NOT NULL,
  PRIMARY KEY  USING BTREE (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 COMMENT='this table defines a template for subscription processing'; 
2014-02-20 15:36:15 - INFO  --> Creating initial subscription record for single purchases in lder_authnet_subscription 
2014-02-20 15:36:15 - INFO  --> Creating table: lder_authnet_payment 
2014-02-20 15:36:15 - DEBUG --> CREATE TABLE  `lder_authnet_payment` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `user_subscription_id` bigint unsigned NOT NULL,
  `xAuthCode` varchar(255) NOT NULL,
  `xTransId` varchar(255) NOT NULL,
  `xAmount` decimal(10,2) NOT NULL,
  `xMethod` varchar(255) NOT NULL,
  `xType` varchar(255) NOT NULL,
  `xSubscriptionId` varchar(255) NULL,
  `xSubscriptionPaynum` int(10) NULL,
  `paymentDate` datetime NOT NULL,
  `fullAuthorizeNetResponse` blob NULL,
  PRIMARY KEY  USING BTREE (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 COMMENT='payment table is child to user_subscription'; 
2014-02-20 15:36:15 - INFO  --> Creating table: lder_authnet_cancellation 
2014-02-20 15:36:15 - DEBUG --> CREATE TABLE  `lder_authnet_cancellation` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `user_subscription_id` bigint unsigned NOT NULL,
  `refId` varchar(255) NOT NULL,
  `reason` blob NULL,
  `xSubscriptionId` int(10) NOT NULL,
  `cancellationDate` datetime NOT NULL,
  `fullAuthorizeNetResponse` blob NOT NULL,
  PRIMARY KEY  USING BTREE (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=1 COMMENT='cancellation table is child to user_subscription'; 
2014-02-20 15:36:15 - INFO  --> added survey field to lder_authnet_subscription 
2014-02-20 15:36:15 - DEBUG --> Page: checkout ready for creation/update 
2014-02-20 15:36:15 - INFO  --> Creating Page: checkout 
2014-02-20 15:37:59 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-02-20 15:39:00 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-02-20 21:55:24 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-02-20 21:58:30 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 13:07:58 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 13:09:45 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 13:13:10 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 13:13:15 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 13:13:20 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 13:20:48 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 13:29:19 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 14:06:43 - INFO  --> Deactivating plugin 
2014-04-07 14:15:22 - INFO  --> Activating/Installing plugin 
2014-04-07 14:15:22 - INFO  --> Creating table: lder_authnet_user_subscription 
2014-04-07 14:15:22 - INFO  --> Table: lder_authnet_user_subscription already exists 
2014-04-07 14:15:22 - INFO  --> Creating table: lder_authnet_subscription 
2014-04-07 14:15:22 - INFO  --> Table: lder_authnet_subscription already exists 
2014-04-07 14:15:22 - INFO  --> Creating table: lder_authnet_payment 
2014-04-07 14:15:22 - INFO  --> Table: lder_authnet_payment already exists 
2014-04-07 14:15:22 - INFO  --> Creating table: lder_authnet_cancellation 
2014-04-07 14:15:22 - INFO  --> Table: lder_authnet_cancellation already exists 
2014-04-07 14:15:22 - DEBUG --> Page: checkout ready for creation/update 
2014-04-07 14:15:22 - INFO  --> Updating Page: checkout 
2014-04-07 14:18:31 - INFO  --> Credit Card type: Visa 
2014-04-07 14:18:31 - DEBUG --> Credit card last four digits: 1111 
2014-04-07 14:18:31 - DEBUG --> Credit card expiration date: 2015-03 
2014-04-07 14:18:31 - INFO  --> Create user with username: [test@noreply.com] password: [Zb3xZg5p] email: [test@noreply.com] 
2014-04-07 14:18:31 - DEBUG --> Create user_subscription record with user_subscription_id: [1] 
2014-04-07 14:18:31 - DEBUG --> HTTP/1.1 200 OK
Date: Mon, 07 Apr 2014 14:18:32 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 452

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-4</refId><messages><resultCode>Error</resultCode><message><code>E00009</code><text>The payment gateway account is in Test Mode. The request cannot be processed.</text></message></messages></ARBCreateSubscriptionResponse> 
2014-04-07 14:18:31 - ERROR --> Failed to create ARB transaction (E00009) The payment gateway account is in Test Mode. The request cannot be processed. 
2014-04-07 14:18:31 - INFO  --> rollbackReturn called 
2014-04-07 14:18:31 - DEBUG --> DELETE FROM lder_authnet_user_subscription WHERE ID = 1 
2014-04-07 14:18:31 - DEBUG --> DELETE FROM lder_authnet_payment WHERE user_subscription_id = 1 
2014-04-07 14:18:31 - DEBUG --> Delete user: 4 
2014-04-07 14:21:59 - INFO  --> Credit Card type: Visa 
2014-04-07 14:21:59 - DEBUG --> Credit card last four digits: 1111 
2014-04-07 14:21:59 - DEBUG --> Credit card expiration date: 2016-02 
2014-04-07 14:21:59 - INFO  --> Create user with username: [test@noreply.com] password: [6FMlzd2F] email: [test@noreply.com] 
2014-04-07 14:21:59 - DEBUG --> Create user_subscription record with user_subscription_id: [2] 
2014-04-07 14:21:59 - DEBUG --> HTTP/1.1 200 OK
Date: Mon, 07 Apr 2014 14:21:59 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 452

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-5</refId><messages><resultCode>Error</resultCode><message><code>E00009</code><text>The payment gateway account is in Test Mode. The request cannot be processed.</text></message></messages></ARBCreateSubscriptionResponse> 
2014-04-07 14:21:59 - ERROR --> Failed to create ARB transaction (E00009) The payment gateway account is in Test Mode. The request cannot be processed. 
2014-04-07 14:21:59 - INFO  --> rollbackReturn called 
2014-04-07 14:21:59 - DEBUG --> DELETE FROM lder_authnet_user_subscription WHERE ID = 2 
2014-04-07 14:21:59 - DEBUG --> DELETE FROM lder_authnet_payment WHERE user_subscription_id = 2 
2014-04-07 14:21:59 - DEBUG --> Delete user: 5 
2014-04-07 14:22:22 - INFO  --> Credit Card type: Visa 
2014-04-07 14:22:22 - DEBUG --> Credit card last four digits: 1111 
2014-04-07 14:22:22 - DEBUG --> Credit card expiration date: 2016-02 
2014-04-07 14:22:22 - INFO  --> Create user with username: [test@noreply.com] password: [DaiL3OXD] email: [test@noreply.com] 
2014-04-07 14:22:22 - DEBUG --> Create user_subscription record with user_subscription_id: [3] 
2014-04-07 14:22:22 - DEBUG --> HTTP/1.1 200 OK
Date: Mon, 07 Apr 2014 14:22:22 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 452

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-6</refId><messages><resultCode>Error</resultCode><message><code>E00009</code><text>The payment gateway account is in Test Mode. The request cannot be processed.</text></message></messages></ARBCreateSubscriptionResponse> 
2014-04-07 14:22:22 - ERROR --> Failed to create ARB transaction (E00009) The payment gateway account is in Test Mode. The request cannot be processed. 
2014-04-07 14:22:22 - INFO  --> rollbackReturn called 
2014-04-07 14:22:22 - DEBUG --> DELETE FROM lder_authnet_user_subscription WHERE ID = 3 
2014-04-07 14:22:22 - DEBUG --> DELETE FROM lder_authnet_payment WHERE user_subscription_id = 3 
2014-04-07 14:22:22 - DEBUG --> Delete user: 6 
2014-04-07 14:23:33 - INFO  --> Credit Card type: Visa 
2014-04-07 14:23:33 - DEBUG --> Credit card last four digits: 1111 
2014-04-07 14:23:33 - DEBUG --> Credit card expiration date: 2015-02 
2014-04-07 14:23:33 - INFO  --> Create user with username: [test@noreply.com] password: [H0GiRp8E] email: [test@noreply.com] 
2014-04-07 14:23:33 - DEBUG --> Create user_subscription record with user_subscription_id: [4] 
2014-04-07 14:23:33 - DEBUG --> HTTP/1.1 200 OK
Date: Mon, 07 Apr 2014 14:23:33 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 439

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-7</refId><messages><resultCode>Error</resultCode><message><code>E00007</code><text>User authentication failed due to invalid authentication values.</text></message></messages></ARBCreateSubscriptionResponse> 
2014-04-07 14:23:33 - ERROR --> Failed to create ARB transaction (E00007) User authentication failed due to invalid authentication values. 
2014-04-07 14:23:33 - INFO  --> rollbackReturn called 
2014-04-07 14:23:33 - DEBUG --> DELETE FROM lder_authnet_user_subscription WHERE ID = 4 
2014-04-07 14:23:33 - DEBUG --> DELETE FROM lder_authnet_payment WHERE user_subscription_id = 4 
2014-04-07 14:23:33 - DEBUG --> Delete user: 7 
2014-04-07 14:24:56 - INFO  --> Credit Card type: Visa 
2014-04-07 14:24:56 - DEBUG --> Credit card last four digits: 1111 
2014-04-07 14:24:56 - DEBUG --> Credit card expiration date: 2015-02 
2014-04-07 14:24:56 - INFO  --> Create user with username: [test@noreply.com] password: [7cenuI2b] email: [test@noreply.com] 
2014-04-07 14:24:56 - DEBUG --> Create user_subscription record with user_subscription_id: [5] 
2014-04-07 14:26:39 - INFO  --> Credit Card type: Visa 
2014-04-07 14:26:39 - DEBUG --> Credit card last four digits: 1111 
2014-04-07 14:26:39 - DEBUG --> Credit card expiration date: 2015-01 
2014-04-07 14:26:39 - INFO  --> Some required address value wasn't provided 
2014-04-07 14:26:39 - INFO  --> rollbackReturn called 
2014-04-07 14:27:02 - INFO  --> Credit Card type: Visa 
2014-04-07 14:27:02 - DEBUG --> Credit card last four digits: 1111 
2014-04-07 14:27:02 - DEBUG --> Credit card expiration date: 2015-01 
2014-04-07 14:27:02 - INFO  --> Found user with user_id: 8 
2014-04-07 14:27:02 - DEBUG --> Create user_subscription record with user_subscription_id: [6] 
2014-04-07 14:27:02 - DEBUG --> HTTP/1.1 200 OK
Date: Mon, 07 Apr 2014 14:27:02 GMT
Server: Microsoft-IIS/6.0
Access-Control-Allow-Origin: http://developer.authorize.net
Access-Control-Allow-Methods: GET, POST, OPTIONS
Access-Control-Allow-Headers: x-requested-with, cache-control, content-type, origin, method
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 423

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-8</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>2047783</subscriptionId></ARBCreateSubscriptionResponse> 
2014-04-07 14:27:29 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 14:27:59 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-07 14:31:10 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-08 18:13:38 - INFO  --> Credit Card type: American Express 
2014-04-08 18:13:38 - DEBUG --> Credit card last four digits: 2005 
2014-04-08 18:13:38 - DEBUG --> Credit card expiration date: 2016-10 
2014-04-08 18:13:38 - INFO  --> Found user with user_id: 3 
2014-04-08 18:13:39 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 30 Response text - The configuration with processor is invalid. Call Merchant Service Provider. 
2014-04-08 18:13:39 - INFO  --> rollbackReturn called 
2014-04-08 18:13:39 - DEBUG --> User either is admin or already existed: 3 (not deleting) 
2014-04-08 21:15:57 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-08 21:20:23 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-08 21:22:56 - INFO  --> Credit Card type: Visa 
2014-04-08 21:22:56 - DEBUG --> Credit card last four digits: 0262 
2014-04-08 21:22:56 - DEBUG --> Credit card expiration date: 2015-06 
2014-04-08 21:22:56 - INFO  --> Create user with username: [ryan.cardwell@northstar.ac] password: [WBNrj84C] email: [ryan.cardwell@northstar.ac] 
2014-04-08 21:22:58 - DEBUG --> Create user_subscription record with user_subscription_id: [7] 
2014-04-08 21:24:50 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-08 21:28:27 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-09 20:30:32 - INFO  --> Credit Card type: Visa 
2014-04-09 20:30:32 - DEBUG --> Credit card last four digits: 1024 
2014-04-09 20:30:32 - DEBUG --> Credit card expiration date: 2015-04 
2014-04-09 20:30:32 - INFO  --> Create user with username: [mwafrica6@gmail.com] password: [E2S9VcxB] email: [mwafrica6@gmail.com] 
2014-04-09 20:30:34 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 27 Response text - The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder. 
2014-04-09 20:30:34 - INFO  --> rollbackReturn called 
2014-04-09 20:30:34 - DEBUG --> Delete user: 10 
2014-04-09 20:32:22 - INFO  --> Credit Card type: Visa 
2014-04-09 20:32:22 - DEBUG --> Credit card last four digits: 1024 
2014-04-09 20:32:22 - DEBUG --> Credit card expiration date: 2015-04 
2014-04-09 20:32:22 - INFO  --> Create user with username: [mwafrica6@gmail.com] password: [3UCNtHwS] email: [mwafrica6@gmail.com] 
2014-04-09 20:32:24 - DEBUG --> Create user_subscription record with user_subscription_id: [8] 
2014-04-11 10:42:21 - INFO  --> Credit Card type: Visa 
2014-04-11 10:42:21 - DEBUG --> Credit card last four digits: 1024 
2014-04-11 10:42:21 - DEBUG --> Credit card expiration date: 2015-04 
2014-04-11 10:42:21 - INFO  --> Found user with user_id: 11 
2014-04-11 10:42:23 - DEBUG --> Create user_subscription record with user_subscription_id: [9] 
2014-04-28 13:12:34 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-28 13:15:51 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-04-28 13:38:06 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-05-01 10:04:42 - INFO  --> Credit Card type: American Express 
2014-05-01 10:04:42 - DEBUG --> Credit card last four digits: 1009 
2014-05-01 10:04:42 - DEBUG --> Credit card expiration date: 2015-12 
2014-05-01 10:04:42 - INFO  --> Create user with username: [mailnoble@gmail.com] password: [tjs3IBw3] email: [mailnoble@gmail.com] 
2014-05-01 10:04:46 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 30 Response text - The configuration with processor is invalid. Call Merchant Service Provider. 
2014-05-01 10:04:46 - INFO  --> rollbackReturn called 
2014-05-01 10:04:46 - DEBUG --> Delete user: 12 
2014-05-01 10:05:36 - INFO  --> Credit Card type: American Express 
2014-05-01 10:05:36 - DEBUG --> Credit card last four digits: 1009 
2014-05-01 10:05:36 - DEBUG --> Credit card expiration date: 2015-12 
2014-05-01 10:05:36 - INFO  --> Create user with username: [mailnoble@gmail.com] password: [2e3fYATj] email: [mailnoble@gmail.com] 
2014-05-01 10:05:39 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 30 Response text - The configuration with processor is invalid. Call Merchant Service Provider. 
2014-05-01 10:05:39 - INFO  --> rollbackReturn called 
2014-05-01 10:05:39 - DEBUG --> Delete user: 13 
2014-05-01 10:18:55 - INFO  --> Credit Card type: American Express 
2014-05-01 10:18:55 - DEBUG --> Credit card last four digits: 1009 
2014-05-01 10:18:55 - DEBUG --> Credit card expiration date: 2015-12 
2014-05-01 10:18:55 - INFO  --> Create user with username: [mailnoble@gmail.com] password: [JLe2MHFs] email: [mailnoble@gmail.com] 
2014-05-01 10:18:57 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 30 Response text - The configuration with processor is invalid. Call Merchant Service Provider. 
2014-05-01 10:18:57 - INFO  --> rollbackReturn called 
2014-05-01 10:18:57 - DEBUG --> Delete user: 14 
2014-05-01 10:23:52 - INFO  --> Credit Card type: Visa 
2014-05-01 10:23:52 - DEBUG --> Credit card last four digits: 2240 
2014-05-01 10:23:52 - DEBUG --> Credit card expiration date: 2015-04 
2014-05-01 10:23:52 - INFO  --> Create user with username: [mailnoble@gmail.com] password: [OF7qp7ZZ] email: [mailnoble@gmail.com] 
2014-05-01 10:23:56 - DEBUG --> Create user_subscription record with user_subscription_id: [10] 
2014-05-03 17:53:54 - INFO  --> Credit Card type: Visa 
2014-05-03 17:53:54 - DEBUG --> Credit card last four digits: 6725 
2014-05-03 17:53:54 - DEBUG --> Credit card expiration date: 2016-01 
2014-05-03 17:53:54 - INFO  --> Create user with username: [tana.pritchard@gmail.com] password: [RijgyEtb] email: [tana.pritchard@gmail.com] 
2014-05-03 17:53:55 - DEBUG --> Create user_subscription record with user_subscription_id: [11] 
2014-05-03 17:53:55 - DEBUG --> HTTP/1.1 200 OK
Date: Sat, 03 May 2014 17:53:55 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 425

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-16</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>20608268</subscriptionId></ARBCreateSubscriptionResponse> 
2014-05-03 17:57:04 - INFO  --> Credit Card type: Visa 
2014-05-03 17:57:04 - DEBUG --> Credit card last four digits: 1587 
2014-05-03 17:57:04 - DEBUG --> Credit card expiration date: 2016-02 
2014-05-03 17:57:04 - INFO  --> Create user with username: [christenson.taylor@gmail.com] password: [rX9LK71o] email: [christenson.taylor@gmail.com] 
2014-05-03 17:57:04 - DEBUG --> Create user_subscription record with user_subscription_id: [12] 
2014-05-03 17:57:04 - DEBUG --> HTTP/1.1 200 OK
Date: Sat, 03 May 2014 17:57:03 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 425

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-17</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>20608289</subscriptionId></ARBCreateSubscriptionResponse> 
2014-05-09 9:08:21 - INFO  --> Credit Card type: Visa 
2014-05-09 9:08:21 - DEBUG --> Credit card last four digits: 2447 
2014-05-09 9:08:21 - DEBUG --> Credit card expiration date: 2017-10 
2014-05-09 9:08:21 - INFO  --> Found user with user_id: 3 
2014-05-09 9:08:23 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 27 Response text - The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder. 
2014-05-09 9:08:23 - INFO  --> rollbackReturn called 
2014-05-09 9:08:23 - DEBUG --> User either is admin or already existed: 3 (not deleting) 
2014-05-09 9:10:15 - INFO  --> Credit Card type: Visa 
2014-05-09 9:10:15 - DEBUG --> Credit card last four digits: 2447 
2014-05-09 9:10:15 - DEBUG --> Credit card expiration date: 2017-10 
2014-05-09 9:10:15 - INFO  --> Found user with user_id: 3 
2014-05-09 9:10:17 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 27 Response text - The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder. 
2014-05-09 9:10:17 - INFO  --> rollbackReturn called 
2014-05-09 9:10:17 - DEBUG --> User either is admin or already existed: 3 (not deleting) 
2014-05-09 9:12:12 - INFO  --> Credit Card type: Visa 
2014-05-09 9:12:12 - DEBUG --> Credit card last four digits: 2447 
2014-05-09 9:12:12 - DEBUG --> Credit card expiration date: 2017-10 
2014-05-09 9:12:12 - INFO  --> Found user with user_id: 3 
2014-05-09 9:12:14 - DEBUG --> Create user_subscription record with user_subscription_id: [13] 
2014-05-12 16:10:53 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-05-12 16:43:59 - INFO  --> Credit Card type: Visa 
2014-05-12 16:43:59 - DEBUG --> Credit card last four digits: 9936 
2014-05-12 16:43:59 - DEBUG --> Credit card expiration date: 2015-11 
2014-05-12 16:43:59 - INFO  --> Create user with username: [john@kj-wm.com] password: [1l2bu5Vc] email: [john@kj-wm.com] 
2014-05-12 16:43:59 - DEBUG --> Create user_subscription record with user_subscription_id: [14] 
2014-05-12 16:44:00 - DEBUG --> HTTP/1.1 200 OK
Date: Mon, 12 May 2014 16:44:00 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 425

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-18</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>20687009</subscriptionId></ARBCreateSubscriptionResponse> 
2014-05-12 23:28:36 - INFO  --> Credit Card type: Visa 
2014-05-12 23:28:36 - DEBUG --> Credit card last four digits: 6725 
2014-05-12 23:28:36 - DEBUG --> Credit card expiration date: 2016-01 
2014-05-12 23:28:36 - INFO  --> Found user with user_id: 16 
2014-05-12 23:28:36 - DEBUG --> Create user_subscription record with user_subscription_id: [15] 
2014-05-12 23:28:37 - DEBUG --> HTTP/1.1 200 OK
Date: Mon, 12 May 2014 23:28:37 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 425

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-16</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>20693353</subscriptionId></ARBCreateSubscriptionResponse> 
2014-05-14 20:52:14 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-05-14 20:52:22 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-05-14 20:52:35 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-05-14 21:03:16 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2014-05-26 13:09:56 - INFO  --> Credit Card type: Visa 
2014-05-26 13:09:56 - DEBUG --> Credit card last four digits: 4858 
2014-05-26 13:09:56 - DEBUG --> Credit card expiration date: 2015-08 
2014-05-26 13:09:56 - INFO  --> rollbackReturn called 
2014-05-26 13:11:10 - INFO  --> Credit Card type: Visa 
2014-05-26 13:11:10 - DEBUG --> Credit card last four digits: 4858 
2014-05-26 13:11:10 - DEBUG --> Credit card expiration date: 2015-08 
2014-05-26 13:11:10 - INFO  --> Found user with user_id: 3 
2014-05-26 13:11:12 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 27 Response text - The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder. 
2014-05-26 13:11:12 - INFO  --> rollbackReturn called 
2014-05-26 13:11:12 - DEBUG --> User either is admin or already existed: 3 (not deleting) 
2014-05-26 13:15:12 - INFO  --> Credit Card type: Visa 
2014-05-26 13:15:12 - DEBUG --> Credit card last four digits: 4858 
2014-05-26 13:15:12 - DEBUG --> Credit card expiration date: 2015-08 
2014-05-26 13:15:12 - INFO  --> Found user with user_id: 3 
2014-05-26 13:15:14 - DEBUG --> Create user_subscription record with user_subscription_id: [16] 
2014-05-27 19:45:18 - INFO  --> Credit Card type: Visa 
2014-05-27 19:45:18 - DEBUG --> Credit card last four digits: 0508 
2014-05-27 19:45:18 - DEBUG --> Credit card expiration date: 2016-09 
2014-05-27 19:45:18 - INFO  --> Create user with username: [emilyw89@gmail.com] password: [hAVCnsJH] email: [emilyw89@gmail.com] 
2014-05-27 19:45:18 - DEBUG --> Create user_subscription record with user_subscription_id: [17] 
2014-05-27 19:45:19 - DEBUG --> HTTP/1.1 200 OK
Date: Tue, 27 May 2014 19:45:19 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 425

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-19</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>20860598</subscriptionId></ARBCreateSubscriptionResponse> 
2014-05-27 19:47:12 - INFO  --> Credit Card type: Visa 
2014-05-27 19:47:12 - DEBUG --> Credit card last four digits: 2735 
2014-05-27 19:47:12 - DEBUG --> Credit card expiration date: 2017-03 
2014-05-27 19:47:12 - INFO  --> Create user with username: [kelseydan07@gmail.com] password: [HRl6q4R5] email: [kelseydan07@gmail.com] 
2014-05-27 19:47:12 - DEBUG --> Create user_subscription record with user_subscription_id: [18] 
2014-05-27 19:47:13 - DEBUG --> HTTP/1.1 200 OK
Date: Tue, 27 May 2014 19:47:12 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 425

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-20</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>20860627</subscriptionId></ARBCreateSubscriptionResponse> 
2014-05-27 19:50:06 - INFO  --> Credit Card type: Visa 
2014-05-27 19:50:06 - DEBUG --> Credit card last four digits: 2347 
2014-05-27 19:50:06 - DEBUG --> Credit card expiration date: 2016-11 
2014-05-27 19:50:06 - INFO  --> Create user with username: [sara.fortune@yahoo.com] password: [RqFqbsDj] email: [sara.fortune@yahoo.com] 
2014-05-27 19:50:06 - DEBUG --> Create user_subscription record with user_subscription_id: [19] 
2014-05-27 19:50:07 - DEBUG --> HTTP/1.1 200 OK
Date: Tue, 27 May 2014 19:50:06 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 425

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-21</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>20860701</subscriptionId></ARBCreateSubscriptionResponse> 
2014-05-27 19:55:21 - INFO  --> Credit Card type: Visa 
2014-05-27 19:55:21 - DEBUG --> Credit card last four digits: 5251 
2014-05-27 19:55:21 - DEBUG --> Credit card expiration date: 2016-09 
2014-05-27 19:55:21 - INFO  --> Create user with username: [mcdougab@gmail.com] password: [7B5sUjVl] email: [mcdougab@gmail.com] 
2014-05-27 19:55:21 - DEBUG --> Create user_subscription record with user_subscription_id: [20] 
2014-05-27 19:55:22 - DEBUG --> HTTP/1.1 200 OK
Date: Tue, 27 May 2014 19:55:22 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 425

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-22</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>20860801</subscriptionId></ARBCreateSubscriptionResponse> 
2014-05-27 19:57:07 - INFO  --> Credit Card type: Visa 
2014-05-27 19:57:07 - DEBUG --> Credit card last four digits: 8693 
2014-05-27 19:57:07 - DEBUG --> Credit card expiration date: 2017-04 
2014-05-27 19:57:07 - INFO  --> Create user with username: [jessica12mitchell@gmail.com] password: [e9GQv57T] email: [jessica12mitchell@gmail.com] 
2014-05-27 19:57:07 - DEBUG --> Create user_subscription record with user_subscription_id: [21] 
2014-05-27 19:57:07 - DEBUG --> HTTP/1.1 200 OK
Date: Tue, 27 May 2014 19:57:07 GMT
Server: Microsoft-IIS/6.0
X-Powered-By: ASP.NET
X-AspNet-Version: 2.0.50727
Cache-Control: private
Content-Type: text/xml; charset=utf-8
Content-Length: 425

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-23</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>20860835</subscriptionId></ARBCreateSubscriptionResponse> 
2014-05-29 18:20:46 - INFO  --> Credit Card type: Visa 
2014-05-29 18:20:46 - DEBUG --> Credit card last four digits: 7016 
2014-05-29 18:20:46 - DEBUG --> Credit card expiration date: 2015-05 
2014-05-29 18:20:46 - INFO  --> Create user with username: [weislass@yahoo.com] password: [8LFYSh9g] email: [weislass@yahoo.com] 
2014-05-29 18:20:48 - DEBUG --> Create user_subscription record with user_subscription_id: [22] 
2014-06-01 18:01:24 - INFO  --> Credit Card type: Visa 
2014-06-01 18:01:24 - DEBUG --> Credit card last four digits: 9801 
2014-06-01 18:01:24 - DEBUG --> Credit card expiration date: 2014-11 
2014-06-01 18:01:24 - INFO  --> Create user with username: [Robertsonhearing@yahoo.com] password: [qfoBsRMg] email: [Robertsonhearing@yahoo.com] 
2014-06-01 18:01:27 - DEBUG --> Create user_subscription record with user_subscription_id: [23] 
2014-07-13 21:50:10 - INFO  --> Credit Card type: Visa 
2014-07-13 21:50:10 - DEBUG --> Credit card last four digits: 9356 
2014-07-13 21:50:10 - DEBUG --> Credit card expiration date: 2018-02 
2014-07-13 21:50:10 - INFO  --> Create user with username: [rgrose712@gmail.com] password: [zWsnZ29k] email: [rgrose712@gmail.com] 
2014-07-13 21:50:13 - DEBUG --> Create user_subscription record with user_subscription_id: [24] 
2014-07-24 17:36:31 - INFO  --> Credit Card type: MasterCard 
2014-07-24 17:36:31 - DEBUG --> Credit card last four digits: 2069 
2014-07-24 17:36:31 - DEBUG --> Credit card expiration date: 2017-10 
2014-07-24 17:36:31 - INFO  --> Create user with username: [glritter@comcast.net] password: [qgYmFWBP] email: [glritter@comcast.net] 
2014-07-24 17:36:31 - DEBUG --> Create user_subscription record with user_subscription_id: [25] 
2014-07-24 17:36:32 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: text/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Thu, 24 Jul 2014 17:36:32 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-27</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>21557662</subscriptionId></ARBCreateSubscriptionResponse> 
2014-08-05 16:52:49 - INFO  --> Credit Card type: Visa 
2014-08-05 16:52:49 - DEBUG --> Credit card last four digits: 6237 
2014-08-05 16:52:49 - DEBUG --> Credit card expiration date: 2015-07 
2014-08-05 16:52:49 - INFO  --> Create user with username: [mark@leadershipintl.org] password: [TQszThDJ] email: [mark@leadershipintl.org] 
2014-08-05 16:52:52 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 2 Response text - This transaction has been declined. 
2014-08-05 16:52:52 - INFO  --> rollbackReturn called 
2014-08-05 16:52:52 - DEBUG --> Delete user: 28 
2014-08-05 16:53:37 - INFO  --> Credit Card type: Visa 
2014-08-05 16:53:37 - DEBUG --> Credit card last four digits: 6237 
2014-08-05 16:53:37 - DEBUG --> Credit card expiration date: 2015-07 
2014-08-05 16:53:37 - INFO  --> Create user with username: [mark@leadershipintl.org] password: [NSqoQu6W] email: [mark@leadershipintl.org] 
2014-08-05 16:53:38 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 2 Response text - This transaction has been declined. 
2014-08-05 16:53:38 - INFO  --> rollbackReturn called 
2014-08-05 16:53:38 - DEBUG --> Delete user: 29 
2014-08-05 16:54:46 - INFO  --> Credit Card type: Visa 
2014-08-05 16:54:46 - DEBUG --> Credit card last four digits: 6237 
2014-08-05 16:54:46 - DEBUG --> Credit card expiration date: 2015-07 
2014-08-05 16:54:46 - INFO  --> Create user with username: [mark@leadershipintl.org] password: [BNGvVBCo] email: [mark@leadershipintl.org] 
2014-08-05 16:54:48 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 2 Response text - This transaction has been declined. 
2014-08-05 16:54:48 - INFO  --> rollbackReturn called 
2014-08-05 16:54:48 - DEBUG --> Delete user: 30 
2014-08-05 16:57:24 - INFO  --> Credit Card type: Visa 
2014-08-05 16:57:24 - DEBUG --> Credit card last four digits: 3492 
2014-08-05 16:57:24 - DEBUG --> Credit card expiration date: 2015-11 
2014-08-05 16:57:24 - INFO  --> Create user with username: [mark@leadershipintl.org] password: [K4xfR2Jn] email: [mark@leadershipintl.org] 
2014-08-05 16:57:26 - DEBUG --> Create user_subscription record with user_subscription_id: [26] 
2014-08-13 21:33:35 - INFO  --> Credit Card type: American Express 
2014-08-13 21:33:35 - DEBUG --> Credit card last four digits: 7008 
2014-08-13 21:33:35 - DEBUG --> Credit card expiration date: 2017-09 
2014-08-13 21:33:35 - INFO  --> Create user with username: [bansley@fnbmerchants.com] password: [XJI7hBD6] email: [bansley@fnbmerchants.com] 
2014-08-13 21:33:38 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 30 Response text - The configuration with processor is invalid. Call Merchant Service Provider. 
2014-08-13 21:33:38 - INFO  --> rollbackReturn called 
2014-08-13 21:33:38 - DEBUG --> Delete user: 33 
2014-08-13 21:36:39 - INFO  --> Credit Card type: MasterCard 
2014-08-13 21:36:39 - DEBUG --> Credit card last four digits: 8105 
2014-08-13 21:36:39 - DEBUG --> Credit card expiration date: 2015-10 
2014-08-13 21:36:39 - INFO  --> Create user with username: [bansley@fnbmerchants.com] password: [ksYWnEsV] email: [bansley@fnbmerchants.com] 
2014-08-13 21:36:41 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 2 Response text - This transaction has been declined. 
2014-08-13 21:36:41 - INFO  --> rollbackReturn called 
2014-08-13 21:36:41 - DEBUG --> Delete user: 34 
2014-08-13 21:39:21 - INFO  --> Credit Card type: MasterCard 
2014-08-13 21:39:21 - DEBUG --> Credit card last four digits: 8105 
2014-08-13 21:39:21 - DEBUG --> Credit card expiration date: 2015-10 
2014-08-13 21:39:21 - INFO  --> Create user with username: [bansley@fnbmerchants.com] password: [tOMDvVEB] email: [bansley@fnbmerchants.com] 
2014-08-13 21:39:23 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 27 Response text - The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder. 
2014-08-13 21:39:23 - INFO  --> rollbackReturn called 
2014-08-13 21:39:23 - DEBUG --> Delete user: 35 
2014-08-13 21:40:31 - INFO  --> Credit Card type: MasterCard 
2014-08-13 21:40:31 - DEBUG --> Credit card last four digits: 8105 
2014-08-13 21:40:31 - DEBUG --> Credit card expiration date: 2015-10 
2014-08-13 21:40:31 - INFO  --> Create user with username: [bansley@fnbmerchants.com] password: [PbQWKcEm] email: [bansley@fnbmerchants.com] 
2014-08-13 21:40:33 - DEBUG --> Create user_subscription record with user_subscription_id: [27] 
2014-08-18 19:51:53 - INFO  --> Credit Card type: Visa 
2014-08-18 19:51:53 - DEBUG --> Credit card last four digits: 8596 
2014-08-18 19:51:54 - DEBUG --> Credit card expiration date: 2017-06 
2014-08-18 19:51:54 - INFO  --> Create user with username: [aricat323@yahoo.com] password: [gibCpaSr] email: [aricat323@yahoo.com] 
2014-08-18 19:51:54 - DEBUG --> Create user_subscription record with user_subscription_id: [28] 
2014-08-18 19:51:54 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: text/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Mon, 18 Aug 2014 19:51:54 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-37</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>21816714</subscriptionId></ARBCreateSubscriptionResponse> 
2014-08-21 0:28:04 - INFO  --> Credit Card type: Visa 
2014-08-21 0:28:04 - DEBUG --> Credit card last four digits: 9311 
2014-08-21 0:28:04 - DEBUG --> Credit card expiration date: 2016-07 
2014-08-21 0:28:04 - INFO  --> Create user with username: [angodwin@earthlink.net] password: [7jTBu31g] email: [angodwin@earthlink.net] 
2014-08-21 0:28:05 - ERROR --> Credit Card transaction error with authorize.net (3) Reason: 5 Response text - A valid amount is required. 
2014-08-21 0:28:05 - INFO  --> rollbackReturn called 
2014-08-21 0:28:05 - DEBUG --> Delete user: 38 
2014-08-21 0:32:03 - INFO  --> Credit Card type: Visa 
2014-08-21 0:32:03 - DEBUG --> Credit card last four digits: 9311 
2014-08-21 0:32:03 - DEBUG --> Credit card expiration date: 2016-07 
2014-08-21 0:32:03 - INFO  --> Create user with username: [angodwin@earthlink.neg] password: [9frPibpi] email: [angodwin@earthlink.neg] 
2014-08-21 0:32:04 - DEBUG --> Create user_subscription record with user_subscription_id: [29] 
2014-08-24 13:38:55 - INFO  --> Credit Card type: Visa 
2014-08-24 13:38:55 - DEBUG --> Credit card last four digits: 4115 
2014-08-24 13:38:55 - DEBUG --> Credit card expiration date: 2015-02 
2014-08-24 13:38:55 - INFO  --> Create user with username: [nancyw806@yahoo.com] password: [mg076Otf] email: [nancyw806@yahoo.com] 
2014-08-24 13:38:58 - DEBUG --> Create user_subscription record with user_subscription_id: [30] 
2014-08-27 17:55:44 - INFO  --> Credit Card type: MasterCard 
2014-08-27 17:55:44 - DEBUG --> Credit card last four digits: 8496 
2014-08-27 17:55:44 - DEBUG --> Credit card expiration date: 2017-08 
2014-08-27 17:55:44 - INFO  --> Create user with username: [cmcgraw741@gmail.com] password: [ashr7TYu] email: [cmcgraw741@gmail.com] 
2014-08-27 17:55:46 - DEBUG --> Create user_subscription record with user_subscription_id: [31] 
2014-09-03 4:22:15 - INFO  --> Credit Card type: Visa 
2014-09-03 4:22:15 - DEBUG --> Credit card last four digits: 5652 
2014-09-03 4:22:15 - DEBUG --> Credit card expiration date: 2015-10 
2014-09-03 4:22:15 - INFO  --> rollbackReturn called 
2014-09-03 4:23:56 - INFO  --> Credit Card type: Visa 
2014-09-03 4:23:56 - DEBUG --> Credit card last four digits: 5652 
2014-09-03 4:23:56 - DEBUG --> Credit card expiration date: 2015-10 
2014-09-03 4:23:56 - INFO  --> Create user with username: [mpg4@aol.com] password: [gK5N7xzr] email: [mpg4@aol.com] 
2014-09-03 4:23:56 - DEBUG --> Create user_subscription record with user_subscription_id: [32] 
2014-09-03 4:23:57 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: text/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Wed, 03 Sep 2014 04:23:56 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-42</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>21973844</subscriptionId></ARBCreateSubscriptionResponse> 
2014-09-04 17:56:00 - INFO  --> Credit Card type: Visa 
2014-09-04 17:56:00 - DEBUG --> Credit card last four digits: 3492 
2014-09-04 17:56:00 - DEBUG --> Credit card expiration date: 2015-11 
2014-09-04 17:56:00 - INFO  --> Create user with username: [markwagnermusic@me.com] password: [WpDu3FVn] email: [markwagnermusic@me.com] 
2014-09-04 17:56:02 - DEBUG --> Create user_subscription record with user_subscription_id: [33] 
2014-09-15 16:32:12 - INFO  --> Credit Card type: Visa 
2014-09-15 16:32:12 - DEBUG --> Credit card last four digits: 8826 
2014-09-15 16:32:12 - DEBUG --> Credit card expiration date: 2017-07 
2014-09-15 16:32:12 - INFO  --> Found user with user_id: 43 
2014-09-15 16:32:12 - DEBUG --> Create user_subscription record with user_subscription_id: [34] 
2014-09-15 16:32:12 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: text/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Mon, 15 Sep 2014 16:32:11 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-43</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>22093368</subscriptionId></ARBCreateSubscriptionResponse> 
2014-09-20 13:20:04 - INFO  --> Credit Card type: American Express 
2014-09-20 13:20:04 - DEBUG --> Credit card last four digits: 1005 
2014-09-20 13:20:04 - DEBUG --> Credit card expiration date: 2015-09 
2014-09-20 13:20:04 - INFO  --> Create user with username: [wagner72@aol.com] password: [LgO8WUZY] email: [wagner72@aol.com] 
2014-09-20 13:20:06 - DEBUG --> Create user_subscription record with user_subscription_id: [35] 
2014-10-01 14:42:50 - INFO  --> Credit Card type: Visa 
2014-10-01 14:42:50 - DEBUG --> Credit card last four digits: 5113 
2014-10-01 14:42:50 - DEBUG --> Credit card expiration date: 2015-08 
2014-10-01 14:42:50 - INFO  --> Create user with username: [cak8u@yahoo.com] password: [RNMlFaZ8] email: [cak8u@yahoo.com] 
2014-10-01 14:42:52 - DEBUG --> Create user_subscription record with user_subscription_id: [36] 
2014-10-15 13:37:51 - INFO  --> Credit Card type: Visa 
2014-10-15 13:37:51 - DEBUG --> Credit card last four digits: 4956 
2014-10-15 13:37:51 - DEBUG --> Credit card expiration date: 2017-03 
2014-10-15 13:37:51 - INFO  --> Create user with username: [cprice@windermere.com] password: [fLaIiyts] email: [cprice@windermere.com] 
2014-10-15 13:37:51 - DEBUG --> Create user_subscription record with user_subscription_id: [37] 
2014-10-15 13:37:52 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: text/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Wed, 15 Oct 2014 13:37:51 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-46</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>22369734</subscriptionId></ARBCreateSubscriptionResponse> 
2014-10-17 16:22:21 - INFO  --> Credit Card type: Visa 
2014-10-17 16:22:21 - DEBUG --> Credit card last four digits: 4956 
2014-10-17 16:22:21 - DEBUG --> Credit card expiration date: 2017-03 
2014-10-17 16:22:21 - INFO  --> Found user with user_id: 46 
2014-10-17 16:22:21 - DEBUG --> Create user_subscription record with user_subscription_id: [38] 
2014-10-17 16:22:22 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: text/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Fri, 17 Oct 2014 16:22:21 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-46</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>22392873</subscriptionId></ARBCreateSubscriptionResponse> 
2014-10-20 21:16:14 - INFO  --> Credit Card type: Visa 
2014-10-20 21:16:14 - DEBUG --> Credit card last four digits: 4128 
2014-10-20 21:16:14 - DEBUG --> Credit card expiration date: 2016-01 
2014-10-20 21:16:14 - INFO  --> Create user with username: [zach@kosturos.com] password: [khpxUUHe] email: [zach@kosturos.com] 
2014-10-20 21:16:14 - DEBUG --> Create user_subscription record with user_subscription_id: [39] 
2014-10-20 21:16:14 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: text/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Mon, 20 Oct 2014 21:16:13 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-47</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>22414930</subscriptionId></ARBCreateSubscriptionResponse> 
2014-10-26 0:53:52 - INFO  --> Credit Card type: Visa 
2014-10-26 0:53:52 - DEBUG --> Credit card last four digits: 6218 
2014-10-26 0:53:52 - DEBUG --> Credit card expiration date: 2017-10 
2014-10-26 0:53:52 - INFO  --> Create user with username: [steve.french@comcast.net] password: [hjs3lhnL] email: [steve.french@comcast.net] 
2014-10-26 0:53:55 - DEBUG --> Create user_subscription record with user_subscription_id: [40] 
2014-10-31 17:14:09 - INFO  --> Credit Card type: Visa 
2014-10-31 17:14:09 - DEBUG --> Credit card last four digits: 0779 
2014-10-31 17:14:09 - DEBUG --> Credit card expiration date: 2016-06 
2014-10-31 17:14:09 - INFO  --> Create user with username: [markfox57@gmail.com] password: [UfqMTq9y] email: [markfox57@gmail.com] 
2014-10-31 17:14:09 - DEBUG --> Create user_subscription record with user_subscription_id: [41] 
2014-10-31 17:14:10 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: text/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Fri, 31 Oct 2014 17:14:09 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-49</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>22518192</subscriptionId></ARBCreateSubscriptionResponse> 
2014-11-18 20:06:30 - INFO  --> Credit Card type: MasterCard 
2014-11-18 20:06:30 - ERROR --> Credit Card error (2) Credit card number has invalid format 
2014-11-18 20:06:30 - INFO  --> rollbackReturn called 
2014-11-18 20:10:10 - INFO  --> Credit Card type: MasterCard 
2014-11-18 20:10:10 - DEBUG --> Credit card last four digits: 7605 
2014-11-18 20:10:10 - DEBUG --> Credit card expiration date: 2015-04 
2014-11-18 20:10:10 - INFO  --> Create user with username: [wynter@innericonfitness.com] password: [oLMuxGKK] email: [wynter@innericonfitness.com] 
2014-11-18 20:10:10 - DEBUG --> Create user_subscription record with user_subscription_id: [42] 
2014-11-18 20:10:16 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Tue, 18 Nov 2014 20:10:16 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-50</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>22688047</subscriptionId></ARBCreateSubscriptionResponse> 
2014-11-26 16:57:09 - INFO  --> Credit Card type: Visa 
2014-11-26 16:57:09 - DEBUG --> Credit card last four digits: 0752 
2014-11-26 16:57:09 - DEBUG --> Credit card expiration date: 2017-05 
2014-11-26 16:57:09 - INFO  --> Create user with username: [recroom1@belsouth.net] password: [zV2J5bmS] email: [recroom1@belsouth.net] 
2014-11-26 16:57:11 - DEBUG --> Create user_subscription record with user_subscription_id: [43] 
2014-12-06 4:43:00 - INFO  --> Credit Card type: Visa 
2014-12-06 4:43:00 - DEBUG --> Credit card last four digits: 9356 
2014-12-06 4:43:00 - DEBUG --> Credit card expiration date: 2018-02 
2014-12-06 4:43:00 - INFO  --> Found user with user_id: 26 
2014-12-06 4:43:02 - DEBUG --> Create user_subscription record with user_subscription_id: [44] 
2014-12-06 18:54:14 - INFO  --> Credit Card type: MasterCard 
2014-12-06 18:54:14 - DEBUG --> Credit card last four digits: 5887 
2014-12-06 18:54:14 - DEBUG --> Credit card expiration date: 2015-03 
2014-12-06 18:54:14 - INFO  --> Create user with username: [bobbyguy91@gmail.com] password: [6iSHfCEH] email: [bobbyguy91@gmail.com] 
2014-12-06 18:54:17 - DEBUG --> Create user_subscription record with user_subscription_id: [45] 
2014-12-09 22:59:07 - INFO  --> Credit Card type: American Express 
2014-12-09 22:59:07 - DEBUG --> Credit card last four digits: 7008 
2014-12-09 22:59:07 - DEBUG --> Credit card expiration date: 2017-09 
2014-12-09 22:59:07 - INFO  --> Create user with username: [fearlessf8h@yahoo.com] password: [POtPhGmp] email: [fearlessf8h@yahoo.com] 
2014-12-09 22:59:10 - DEBUG --> Create user_subscription record with user_subscription_id: [46] 
2014-12-10 18:58:45 - INFO  --> Credit Card type: Visa 
2014-12-10 18:58:45 - DEBUG --> Credit card last four digits: 5113 
2014-12-10 18:58:45 - DEBUG --> Credit card expiration date: 2015-08 
2014-12-10 18:58:45 - INFO  --> Found user with user_id: 45 
2014-12-10 18:58:48 - DEBUG --> Create user_subscription record with user_subscription_id: [47] 
2014-12-19 3:02:26 - INFO  --> Credit Card type: Visa 
2014-12-19 3:02:26 - DEBUG --> Credit card last four digits: 4691 
2014-12-19 3:02:26 - DEBUG --> Credit card expiration date: 2018-04 
2014-12-19 3:02:27 - INFO  --> Create user with username: [elizabeth.crockett@comcast.net] password: [yDYaOG6E] email: [elizabeth.crockett@comcast.net] 
2014-12-19 3:02:30 - DEBUG --> Create user_subscription record with user_subscription_id: [48] 
2014-12-20 6:18:42 - INFO  --> Credit Card type: Visa 
2014-12-20 6:18:42 - DEBUG --> Credit card last four digits: 0375 
2014-12-20 6:18:42 - DEBUG --> Credit card expiration date: 2019-11 
2014-12-20 6:18:42 - INFO  --> Create user with username: [Scottstanding@gmail.com] password: [SEQldCLl] email: [Scottstanding@gmail.com] 
2014-12-20 6:18:45 - DEBUG --> Create user_subscription record with user_subscription_id: [49] 
2014-12-31 3:34:33 - INFO  --> Credit Card type: Visa 
2014-12-31 3:34:33 - DEBUG --> Credit card last four digits: 8412 
2014-12-31 3:34:33 - DEBUG --> Credit card expiration date: 2017-09 
2014-12-31 3:34:33 - INFO  --> Create user with username: [marti@mdiweb.org] password: [qAogPC7l] email: [marti@mdiweb.org] 
2014-12-31 3:34:35 - DEBUG --> Create user_subscription record with user_subscription_id: [50] 
2014-12-31 15:50:54 - INFO  --> Credit Card type: Visa 
2014-12-31 15:50:54 - DEBUG --> Credit card last four digits: 5766 
2014-12-31 15:50:54 - DEBUG --> Credit card expiration date: 2015-03 
2014-12-31 15:50:54 - INFO  --> Create user with username: [MINNIFAM@BELLSOUTH.NET] password: [7j00VRUV] email: [MINNIFAM@BELLSOUTH.NET] 
2014-12-31 15:50:56 - DEBUG --> Create user_subscription record with user_subscription_id: [51] 
2014-12-31 23:24:11 - INFO  --> Credit Card type: Visa 
2014-12-31 23:24:11 - DEBUG --> Credit card last four digits: 1951 
2014-12-31 23:24:11 - DEBUG --> Credit card expiration date: 2016-09 
2014-12-31 23:24:11 - INFO  --> Create user with username: [atkinscastle@hotmail.com] password: [W32CUCUS] email: [atkinscastle@hotmail.com] 
2014-12-31 23:24:14 - DEBUG --> Create user_subscription record with user_subscription_id: [52] 
2015-01-01 4:21:03 - INFO  --> Credit Card type: Visa 
2015-01-01 4:21:03 - DEBUG --> Credit card last four digits: 7063 
2015-01-01 4:21:03 - DEBUG --> Credit card expiration date: 2017-12 
2015-01-01 4:21:03 - INFO  --> Create user with username: [williamandheidi@gmail.com] password: [4QoEiHYp] email: [williamandheidi@gmail.com] 
2015-01-01 4:21:06 - DEBUG --> Create user_subscription record with user_subscription_id: [53] 
2015-01-13 18:12:06 - INFO  --> Credit Card type: Visa 
2015-01-13 18:12:06 - DEBUG --> Credit card last four digits: 8826 
2015-01-13 18:12:06 - DEBUG --> Credit card expiration date: 2017-07 
2015-01-13 18:12:06 - INFO  --> Found user with user_id: 43 
2015-01-13 18:12:09 - DEBUG --> Create user_subscription record with user_subscription_id: [54] 
2015-01-17 22:26:09 - INFO  --> Credit Card type: American Express 
2015-01-17 22:26:09 - DEBUG --> Credit card last four digits: 4002 
2015-01-17 22:26:09 - DEBUG --> Credit card expiration date: 2016-02 
2015-01-17 22:26:09 - INFO  --> Create user with username: [dina.pancoast@gmail.com] password: [G7Q8zzAs] email: [dina.pancoast@gmail.com] 
2015-01-17 22:26:12 - DEBUG --> Create user_subscription record with user_subscription_id: [55] 
2015-01-20 19:36:59 - INFO  --> Credit Card type: MasterCard 
2015-01-20 19:36:59 - DEBUG --> Credit card last four digits: 4175 
2015-01-20 19:36:59 - DEBUG --> Credit card expiration date: 2017-10 
2015-01-20 19:36:59 - INFO  --> Create user with username: [karisha.nicole@gmail.com] password: [HYVXTUmC] email: [karisha.nicole@gmail.com] 
2015-01-20 19:36:59 - DEBUG --> Create user_subscription record with user_subscription_id: [56] 
2015-01-20 19:37:00 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Tue, 20 Jan 2015 19:37:00 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-61</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>23232694</subscriptionId></ARBCreateSubscriptionResponse> 
2015-01-21 4:37:44 - INFO  --> Credit Card type: Visa 
2015-01-21 4:37:44 - ERROR --> Credit Card error (3) Credit card number is invalid 
2015-01-21 4:37:44 - INFO  --> rollbackReturn called 
2015-01-21 4:39:06 - INFO  --> Credit Card type: Visa 
2015-01-21 4:39:06 - DEBUG --> Credit card last four digits: 4858 
2015-01-21 4:39:06 - DEBUG --> Credit card expiration date: 2015-08 
2015-01-21 4:39:06 - INFO  --> Found user with user_id: 3 
2015-01-21 4:39:09 - DEBUG --> Create user_subscription record with user_subscription_id: [57] 
2015-01-22 18:26:17 - INFO  --> Credit Card type:  
2015-01-22 18:26:17 - ERROR --> Credit Card error (0) Unknown card type 
2015-01-22 18:26:17 - INFO  --> rollbackReturn called 
2015-01-23 6:49:54 - INFO  --> Credit Card type: MasterCard 
2015-01-23 6:49:54 - DEBUG --> Credit card last four digits: 0241 
2015-01-23 6:49:54 - DEBUG --> Credit card expiration date: 2017-10 
2015-01-23 6:49:54 - INFO  --> Create user with username: [treacyharris@hotmail.com] password: [AexXOWmp] email: [treacyharris@hotmail.com] 
2015-01-23 6:49:54 - DEBUG --> Create user_subscription record with user_subscription_id: [58] 
2015-01-23 6:49:54 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Fri, 23 Jan 2015 06:49:55 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-62</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>23260262</subscriptionId></ARBCreateSubscriptionResponse> 
2015-01-27 21:38:18 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-02-15 21:10:51 - INFO  --> Credit Card type: Visa 
2015-02-15 21:10:51 - DEBUG --> Credit card last four digits: 7385 
2015-02-15 21:10:51 - DEBUG --> Credit card expiration date: 2016-05 
2015-02-15 21:10:51 - INFO  --> Create user with username: [stuff2ster@gmail.com] password: [GdbPVwhu] email: [stuff2ster@gmail.com] 
2015-02-15 21:10:51 - DEBUG --> Create user_subscription record with user_subscription_id: [59] 
2015-02-15 21:10:52 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Date: Sun, 15 Feb 2015 21:10:53 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-63</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>23489246</subscriptionId></ARBCreateSubscriptionResponse> 
2015-02-24 17:59:18 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-03-09 3:42:27 - INFO  --> Credit Card type: Visa 
2015-03-09 3:42:27 - DEBUG --> Credit card last four digits: 6744 
2015-03-09 3:42:27 - DEBUG --> Credit card expiration date: 2018-11 
2015-03-09 3:42:27 - INFO  --> Create user with username: [pietros@shaw.ca] password: [NJCMccmZ] email: [pietros@shaw.ca] 
2015-03-09 3:42:30 - DEBUG --> Create user_subscription record with user_subscription_id: [60] 
2015-03-14 3:37:59 - INFO  --> Credit Card type: Visa 
2015-03-14 3:37:59 - DEBUG --> Credit card last four digits: 9356 
2015-03-14 3:37:59 - DEBUG --> Credit card expiration date: 2018-02 
2015-03-14 3:37:59 - INFO  --> Found user with user_id: 26 
2015-03-14 3:38:02 - DEBUG --> Create user_subscription record with user_subscription_id: [61] 
2015-03-30 2:23:12 - INFO  --> Credit Card type: Visa 
2015-03-30 2:23:12 - DEBUG --> Credit card last four digits: 0038 
2015-03-30 2:23:12 - DEBUG --> Credit card expiration date: 2015-12 
2015-03-30 2:23:12 - INFO  --> Create user with username: [jpetey76@hotmail.com] password: [IoQ0ZXZO] email: [jpetey76@hotmail.com] 
2015-03-30 2:23:12 - DEBUG --> Create user_subscription record with user_subscription_id: [62] 
2015-03-30 2:23:13 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Mon, 30 Mar 2015 02:23:14 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-65</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>23906922</subscriptionId></ARBCreateSubscriptionResponse> 
2015-03-30 2:24:43 - INFO  --> Credit Card type: Visa 
2015-03-30 2:24:43 - DEBUG --> Credit card last four digits: 0038 
2015-03-30 2:24:43 - DEBUG --> Credit card expiration date: 2015-12 
2015-03-30 2:24:43 - INFO  --> Found user with user_id: 65 
2015-03-30 2:24:43 - DEBUG --> Create user_subscription record with user_subscription_id: [63] 
2015-03-30 2:24:43 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Mon, 30 Mar 2015 02:24:44 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-65</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>23906928</subscriptionId></ARBCreateSubscriptionResponse> 
2015-04-12 14:18:12 - INFO  --> Credit Card type: Visa 
2015-04-12 14:18:12 - ERROR --> Credit Card error (3) Credit card number is invalid 
2015-04-12 14:18:12 - INFO  --> rollbackReturn called 
2015-04-12 14:22:00 - INFO  --> Credit Card type: Visa 
2015-04-12 14:22:00 - DEBUG --> Credit card last four digits: 3421 
2015-04-12 14:22:00 - DEBUG --> Credit card expiration date: 2017-02 
2015-04-12 14:22:00 - INFO  --> Create user with username: [Rclee704@gmail.com] password: [D9rcHfvT] email: [Rclee704@gmail.com] 
2015-04-12 14:22:06 - DEBUG --> Create user_subscription record with user_subscription_id: [64] 
2015-04-21 18:19:56 - INFO  --> Credit Card type: MasterCard 
2015-04-21 18:19:56 - DEBUG --> Credit card last four digits: 9759 
2015-04-21 18:19:56 - DEBUG --> Credit card expiration date: 2018-03 
2015-04-21 18:19:56 - INFO  --> Create user with username: [wynterweaver@hotmail.com] password: [Em5bW6BD] email: [wynterweaver@hotmail.com] 
2015-04-21 18:19:56 - DEBUG --> Create user_subscription record with user_subscription_id: [65] 
2015-04-21 18:19:58 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Tue, 21 Apr 2015 18:19:59 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-67</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>24117976</subscriptionId></ARBCreateSubscriptionResponse> 
2015-05-13 14:09:07 - INFO  --> Credit Card type: Visa 
2015-05-13 14:09:07 - ERROR --> Credit Card error (3) Credit card number is invalid 
2015-05-13 14:09:07 - INFO  --> rollbackReturn called 
2015-05-13 14:09:29 - INFO  --> Credit Card type: Visa 
2015-05-13 14:09:29 - DEBUG --> Credit card last four digits: 3421 
2015-05-13 14:09:29 - DEBUG --> Credit card expiration date: 2017-02 
2015-05-13 14:09:29 - INFO  --> Found user with user_id: 66 
2015-05-13 14:09:35 - DEBUG --> Create user_subscription record with user_subscription_id: [66] 
2015-05-22 22:09:12 - INFO  --> Credit Card type: Visa 
2015-05-22 22:09:12 - DEBUG --> Credit card last four digits: 0120 
2015-05-22 22:09:12 - DEBUG --> Credit card expiration date: 2016-07 
2015-05-22 22:09:12 - INFO  --> Create user with username: [browns4785@yahoo.com] password: [MfJ5uLZa] email: [browns4785@yahoo.com] 
2015-05-22 22:09:19 - DEBUG --> Create user_subscription record with user_subscription_id: [67] 
2015-05-27 3:01:02 - INFO  --> Credit Card type: Visa 
2015-05-27 3:01:02 - DEBUG --> Credit card last four digits: 8254 
2015-05-27 3:01:02 - DEBUG --> Credit card expiration date: 2018-03 
2015-05-27 3:01:02 - INFO  --> Create user with username: [theriedels@bellsouth.net] password: [TzkBsEDm] email: [theriedels@bellsouth.net] 
2015-05-27 3:01:09 - DEBUG --> Create user_subscription record with user_subscription_id: [68] 
2015-05-28 18:23:09 - INFO  --> Credit Card type: MasterCard 
2015-05-28 18:23:09 - DEBUG --> Credit card last four digits: 5062 
2015-05-28 18:23:09 - DEBUG --> Credit card expiration date: 2019-03 
2015-05-28 18:23:09 - INFO  --> Create user with username: [craig@craigewood.com] password: [ijD55zbY] email: [craig@craigewood.com] 
2015-05-28 18:23:16 - DEBUG --> Create user_subscription record with user_subscription_id: [69] 
2015-05-29 21:25:25 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-05-30 16:56:55 - INFO  --> Credit Card type: Visa 
2015-05-30 16:56:55 - DEBUG --> Credit card last four digits: 3671 
2015-05-30 16:56:55 - DEBUG --> Credit card expiration date: 2016-01 
2015-05-30 16:56:55 - INFO  --> Found user with user_id: 47 
2015-05-30 16:57:02 - DEBUG --> Create user_subscription record with user_subscription_id: [70] 
2015-06-02 6:43:40 - INFO  --> Credit Card type: Visa 
2015-06-02 6:43:40 - DEBUG --> Credit card last four digits: 4369 
2015-06-02 6:43:40 - DEBUG --> Credit card expiration date: 2018-03 
2015-06-02 6:43:40 - INFO  --> Found user with user_id: 43 
2015-06-02 6:43:47 - DEBUG --> Create user_subscription record with user_subscription_id: [71] 
2015-06-16 9:52:01 - INFO  --> Credit Card type: Visa 
2015-06-16 9:52:01 - DEBUG --> Credit card last four digits: 3421 
2015-06-16 9:52:01 - DEBUG --> Credit card expiration date: 2017-02 
2015-06-16 9:52:01 - INFO  --> Found user with user_id: 66 
2015-06-16 9:52:09 - DEBUG --> Create user_subscription record with user_subscription_id: [72] 
2015-07-15 22:43:33 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-07-15 22:50:21 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-07-15 22:55:18 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-07-16 16:46:42 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-07-16 17:29:30 - INFO  --> Credit Card type: MasterCard 
2015-07-16 17:29:30 - DEBUG --> Credit card last four digits: 8771 
2015-07-16 17:29:30 - DEBUG --> Credit card expiration date: 2017-03 
2015-07-16 17:29:31 - INFO  --> Create user with username: [todderickson86th@gmail.com] password: [zX9Z0Ezj] email: [todderickson86th@gmail.com] 
2015-07-16 17:29:33 - DEBUG --> Create user_subscription record with user_subscription_id: [73] 
2015-07-16 17:53:53 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-07-17 21:40:02 - INFO  --> Credit Card type: Visa 
2015-07-17 21:40:02 - DEBUG --> Credit card last four digits: 1162 
2015-07-17 21:40:02 - DEBUG --> Credit card expiration date: 2017-02 
2015-07-17 21:40:02 - INFO  --> Found user with user_id: 66 
2015-07-17 21:40:05 - DEBUG --> Create user_subscription record with user_subscription_id: [74] 
2015-07-20 17:14:24 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-07-20 21:11:29 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-07-29 20:00:32 - INFO  --> Credit Card type: MasterCard 
2015-07-29 20:00:32 - DEBUG --> Credit card last four digits: 3415 
2015-07-29 20:00:32 - DEBUG --> Credit card expiration date: 2018-09 
2015-07-29 20:00:32 - INFO  --> Create user with username: [badger.kathy@gmail.com] password: [gZODNrLr] email: [badger.kathy@gmail.com] 
2015-07-29 20:00:32 - DEBUG --> Create user_subscription record with user_subscription_id: [75] 
2015-07-29 20:00:33 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Wed, 29 Jul 2015 20:00:33 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-72</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25340862</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-02 17:29:30 - INFO  --> Credit Card type: MasterCard 
2015-08-02 17:29:30 - DEBUG --> Credit card last four digits: 6340 
2015-08-02 17:29:30 - DEBUG --> Credit card expiration date: 2018-01 
2015-08-02 17:29:30 - INFO  --> Create user with username: [chad69440@gmail.com] password: [JgCce4Mq] email: [chad69440@gmail.com] 
2015-08-02 17:29:34 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 27 Response text - The transaction has been declined because of an AVS mismatch. The address provided does not match billing address of cardholder. 
2015-08-02 17:29:34 - INFO  --> rollbackReturn called 
2015-08-02 17:29:34 - DEBUG --> Delete user: 73 
2015-08-03 10:46:50 - INFO  --> Credit Card type:  
2015-08-03 10:46:50 - ERROR --> Credit Card error (0) Unknown card type 
2015-08-03 10:46:50 - INFO  --> rollbackReturn called 
2015-08-03 10:49:12 - INFO  --> Credit Card type: MasterCard 
2015-08-03 10:49:12 - DEBUG --> Credit card last four digits: 4484 
2015-08-03 10:49:12 - DEBUG --> Credit card expiration date: 2018-02 
2015-08-03 10:49:12 - INFO  --> Create user with username: [vamccoys@gmail.com] password: [wAVSiofA] email: [vamccoys@gmail.com] 
2015-08-03 10:49:13 - DEBUG --> Create user_subscription record with user_subscription_id: [76] 
2015-08-03 10:49:13 - DEBUG --> HTTP/1.1 100 Continue

HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 465
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Mon, 03 Aug 2015 10:49:14 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-74</refId><messages><resultCode>Error</resultCode><message><code>E00013</code><text>Phone is invalid. Phone can be one of following formats: 111- 111-1111 or (111) 111-1111.</text></message></messages></ARBCreateSubscriptionResponse> 
2015-08-03 10:49:13 - ERROR --> Failed to create ARB transaction (E00013) Phone is invalid. Phone can be one of following formats: 111- 111-1111 or (111) 111-1111. 
2015-08-03 10:49:13 - INFO  --> rollbackReturn called 
2015-08-03 10:49:13 - DEBUG --> DELETE FROM lder_authnet_user_subscription WHERE ID = 76 
2015-08-03 10:49:13 - DEBUG --> DELETE FROM lder_authnet_payment WHERE user_subscription_id = 76 
2015-08-03 10:49:13 - DEBUG --> Delete user: 74 
2015-08-03 10:50:22 - INFO  --> Credit Card type: MasterCard 
2015-08-03 10:50:22 - DEBUG --> Credit card last four digits: 4484 
2015-08-03 10:50:22 - DEBUG --> Credit card expiration date: 2018-02 
2015-08-03 10:50:22 - INFO  --> Create user with username: [vamccoys@gmail.com] password: [beTt0FA4] email: [vamccoys@gmail.com] 
2015-08-03 10:50:22 - DEBUG --> Create user_subscription record with user_subscription_id: [77] 
2015-08-03 10:50:22 - DEBUG --> HTTP/1.1 100 Continue

HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 533
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Mon, 03 Aug 2015 10:50:22 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ErrorResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><messages><resultCode>Error</resultCode><message><code>E00003</code><text>The 'AnetApi/xml/v1/schema/AnetApiSchema.xsd:cardNumber' element is invalid - The value '5491 2371 2724 4484' is invalid according to its datatype 'String' - The actual length is greater than the MaxLength value.</text></message></messages></ErrorResponse> 
2015-08-03 10:50:22 - ERROR --> Failed to create ARB transaction (E00003) The 'AnetApi/xml/v1/schema/AnetApiSchema.xsd:cardNumber' element is invalid - The value '5491 2371 2724 4484' is invalid according to its datatype 'String' - The actual length is greater than the MaxLength value. 
2015-08-03 10:50:22 - INFO  --> rollbackReturn called 
2015-08-03 10:50:22 - DEBUG --> DELETE FROM lder_authnet_user_subscription WHERE ID = 77 
2015-08-03 10:50:22 - DEBUG --> DELETE FROM lder_authnet_payment WHERE user_subscription_id = 77 
2015-08-03 10:50:22 - DEBUG --> Delete user: 75 
2015-08-03 10:51:06 - INFO  --> Credit Card type: MasterCard 
2015-08-03 10:51:06 - DEBUG --> Credit card last four digits: 4484 
2015-08-03 10:51:06 - DEBUG --> Credit card expiration date: 2018-02 
2015-08-03 10:51:06 - INFO  --> Create user with username: [vamccoys@gmail.com] password: [acuJx8gj] email: [vamccoys@gmail.com] 
2015-08-03 10:51:06 - DEBUG --> Create user_subscription record with user_subscription_id: [78] 
2015-08-03 10:51:07 - DEBUG --> HTTP/1.1 100 Continue

HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Mon, 03 Aug 2015 10:51:07 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-76</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25383164</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-03 17:28:40 - INFO  --> Credit Card type: Visa 
2015-08-03 17:28:40 - DEBUG --> Credit card last four digits: 5769 
2015-08-03 17:28:40 - DEBUG --> Credit card expiration date: 2018-01 
2015-08-03 17:28:40 - INFO  --> Create user with username: [jaymesmccann@comcast.net] password: [oA2KKojB] email: [jaymesmccann@comcast.net] 
2015-08-03 17:28:40 - DEBUG --> Create user_subscription record with user_subscription_id: [79] 
2015-08-03 17:28:42 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Mon, 03 Aug 2015 17:28:42 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-77</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25389117</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-04 17:16:40 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-08-04 20:50:02 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-08-05 0:51:47 - INFO  --> Credit Card type: MasterCard 
2015-08-05 0:51:47 - DEBUG --> Credit card last four digits: 6340 
2015-08-05 0:51:47 - DEBUG --> Credit card expiration date: 2018-01 
2015-08-05 0:51:47 - INFO  --> Create user with username: [chad69440@gmail.com] password: [HYg1z2p0] email: [chad69440@gmail.com] 
2015-08-05 0:51:52 - DEBUG --> Create user_subscription record with user_subscription_id: [80] 
2015-08-05 0:53:07 - INFO  --> Credit Card type: MasterCard 
2015-08-05 0:53:07 - DEBUG --> Credit card last four digits: 6340 
2015-08-05 0:53:07 - DEBUG --> Credit card expiration date: 2018-01 
2015-08-05 0:53:07 - INFO  --> Found user with user_id: 79 
2015-08-05 0:53:07 - DEBUG --> Create user_subscription record with user_subscription_id: [81] 
2015-08-05 0:53:08 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Wed, 05 Aug 2015 00:53:08 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-79</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25409214</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-05 12:36:46 - INFO  --> Credit Card type: American Express 
2015-08-05 12:36:46 - DEBUG --> Credit card last four digits: 2014 
2015-08-05 12:36:46 - DEBUG --> Credit card expiration date: 2019-06 
2015-08-05 12:36:46 - INFO  --> Create user with username: [justin.t.miller.2@gmail.com] password: [lhMp2tF2] email: [justin.t.miller.2@gmail.com] 
2015-08-05 12:36:46 - DEBUG --> Create user_subscription record with user_subscription_id: [82] 
2015-08-05 12:36:47 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Wed, 05 Aug 2015 12:36:46 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-80</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25411356</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-05 15:34:24 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-08-10 0:16:34 - INFO  --> Credit Card type: Visa 
2015-08-10 0:16:34 - DEBUG --> Credit card last four digits: 8253 
2015-08-10 0:16:34 - DEBUG --> Credit card expiration date: 2015-11 
2015-08-10 0:16:34 - INFO  --> Create user with username: [benjamin.t.basham@gmail.com] password: [3HaZ3wQ8] email: [benjamin.t.basham@gmail.com] 
2015-08-10 0:16:37 - DEBUG --> Create user_subscription record with user_subscription_id: [83] 
2015-08-12 23:28:44 - INFO  --> Credit Card type: Visa 
2015-08-12 23:28:44 - DEBUG --> Credit card last four digits: 0154 
2015-08-12 23:28:44 - DEBUG --> Credit card expiration date: 2019-09 
2015-08-12 23:28:44 - INFO  --> Create user with username: [vermonter58@verizon.net] password: [PdU0Ll3P] email: [vermonter58@verizon.net] 
2015-08-12 23:28:44 - DEBUG --> Create user_subscription record with user_subscription_id: [84] 
2015-08-12 23:28:45 - DEBUG --> HTTP/1.1 100 Continue

HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 542
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Wed, 12 Aug 2015 23:28:38 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ErrorResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><messages><resultCode>Error</resultCode><message><code>E00003</code><text>The 'AnetApi/xml/v1/schema/AnetApiSchema.xsd:phoneNumber' element is invalid - The value '703-304-1160   703-282-0335' is invalid according to its datatype 'String' - The actual length is greater than the MaxLength value.</text></message></messages></ErrorResponse> 
2015-08-12 23:28:45 - ERROR --> Failed to create ARB transaction (E00003) The 'AnetApi/xml/v1/schema/AnetApiSchema.xsd:phoneNumber' element is invalid - The value '703-304-1160   703-282-0335' is invalid according to its datatype 'String' - The actual length is greater than the MaxLength value. 
2015-08-12 23:28:45 - INFO  --> rollbackReturn called 
2015-08-12 23:28:45 - DEBUG --> DELETE FROM lder_authnet_user_subscription WHERE ID = 84 
2015-08-12 23:28:45 - DEBUG --> DELETE FROM lder_authnet_payment WHERE user_subscription_id = 84 
2015-08-12 23:28:45 - DEBUG --> Delete user: 84 
2015-08-12 23:31:00 - INFO  --> Credit Card type: Visa 
2015-08-12 23:31:00 - DEBUG --> Credit card last four digits: 0154 
2015-08-12 23:31:00 - DEBUG --> Credit card expiration date: 2019-09 
2015-08-12 23:31:00 - INFO  --> Create user with username: [vermonter58@verizon.net] password: [WE35edjh] email: [vermonter58@verizon.net] 
2015-08-12 23:31:00 - DEBUG --> Create user_subscription record with user_subscription_id: [85] 
2015-08-12 23:31:01 - DEBUG --> HTTP/1.1 100 Continue

HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Wed, 12 Aug 2015 23:30:54 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-85</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25495953</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-17 2:47:34 - INFO  --> Credit Card type: MasterCard 
2015-08-17 2:47:34 - DEBUG --> Credit card last four digits: 6176 
2015-08-17 2:47:34 - DEBUG --> Credit card expiration date: 2016-01 
2015-08-17 2:47:34 - INFO  --> Create user with username: [ferona630@gmail.com] password: [VPXyh3jX] email: [ferona630@gmail.com] 
2015-08-17 2:47:36 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 2 Response text - This transaction has been declined. 
2015-08-17 2:47:36 - INFO  --> rollbackReturn called 
2015-08-17 2:47:36 - DEBUG --> Delete user: 86 
2015-08-18 15:00:38 - INFO  --> Credit Card type: American Express 
2015-08-18 15:00:38 - DEBUG --> Credit card last four digits: 1009 
2015-08-18 15:00:38 - DEBUG --> Credit card expiration date: 2016-07 
2015-08-18 15:00:38 - INFO  --> Create user with username: [zcfallon@gmail.com] password: [pFfySYot] email: [zcfallon@gmail.com] 
2015-08-18 15:00:39 - DEBUG --> Create user_subscription record with user_subscription_id: [86] 
2015-08-18 15:00:40 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Tue, 18 Aug 2015 15:00:27 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-87</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25548636</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-18 15:58:08 - INFO  --> Credit Card type: Visa 
2015-08-18 15:58:08 - DEBUG --> Credit card last four digits: 1897 
2015-08-18 15:58:08 - DEBUG --> Credit card expiration date: 2016-12 
2015-08-18 15:58:08 - INFO  --> Create user with username: [jeannecoco@comcast.net] password: [quvWR0RK] email: [jeannecoco@comcast.net] 
2015-08-18 15:58:10 - DEBUG --> Create user_subscription record with user_subscription_id: [87] 
2015-08-18 16:29:21 - INFO  --> Credit Card type: Visa 
2015-08-18 16:29:21 - DEBUG --> Credit card last four digits: 5595 
2015-08-18 16:29:21 - DEBUG --> Credit card expiration date: 2018-02 
2015-08-18 16:29:21 - INFO  --> Create user with username: [business.account.4me@gmail.com] password: [YHnlG5ku] email: [business.account.4me@gmail.com] 
2015-08-18 16:29:23 - DEBUG --> Create user_subscription record with user_subscription_id: [88] 
2015-08-19 19:03:06 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-08-19 21:45:38 - INFO  --> Credit Card type: Visa 
2015-08-19 21:45:38 - DEBUG --> Credit card last four digits: 1683 
2015-08-19 21:45:38 - DEBUG --> Credit card expiration date: 2018-06 
2015-08-19 21:45:38 - INFO  --> Create user with username: [outreachjeramy@gmail.com] password: [ioxwVExs] email: [outreachjeramy@gmail.com] 
2015-08-19 21:45:42 - ERROR --> Credit Card transaction error with authorize.net (2) Reason: 2 Response text - This transaction has been declined. 
2015-08-19 21:45:42 - INFO  --> rollbackReturn called 
2015-08-19 21:45:42 - DEBUG --> Delete user: 90 
2015-08-19 21:46:42 - INFO  --> Credit Card type: Visa 
2015-08-19 21:46:42 - DEBUG --> Credit card last four digits: 1683 
2015-08-19 21:46:42 - DEBUG --> Credit card expiration date: 2018-06 
2015-08-19 21:46:42 - INFO  --> Create user with username: [outreachjeramy@gmail.com] password: [hUNQllGV] email: [outreachjeramy@gmail.com] 
2015-08-19 21:46:46 - DEBUG --> Create user_subscription record with user_subscription_id: [89] 
2015-08-20 12:30:55 - INFO  --> Credit Card type: Visa 
2015-08-20 12:30:55 - DEBUG --> Credit card last four digits: 0424 
2015-08-20 12:30:55 - DEBUG --> Credit card expiration date: 2016-06 
2015-08-20 12:30:55 - INFO  --> Create user with username: [steve.brien@southeastcc.org] password: [wMStiS9L] email: [steve.brien@southeastcc.org] 
2015-08-20 12:30:58 - DEBUG --> Create user_subscription record with user_subscription_id: [90] 
2015-08-20 18:19:18 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-08-20 21:12:53 - INFO  --> Credit Card type: Visa 
2015-08-20 21:12:53 - DEBUG --> Credit card last four digits: 1534 
2015-08-20 21:12:53 - DEBUG --> Credit card expiration date: 2015-11 
2015-08-20 21:12:53 - INFO  --> Create user with username: [Andrew.Harasz@gmail.com] password: [EvtSUpR7] email: [Andrew.Harasz@gmail.com] 
2015-08-20 21:12:53 - DEBUG --> Create user_subscription record with user_subscription_id: [91] 
2015-08-20 21:12:54 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Thu, 20 Aug 2015 21:12:40 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-93</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25581682</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-21 15:28:20 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-08-21 16:02:45 - INFO  --> Credit Card type: Visa 
2015-08-21 16:02:45 - DEBUG --> Credit card last four digits: 1979 
2015-08-21 16:02:45 - DEBUG --> Credit card expiration date: 2016-11 
2015-08-21 16:02:45 - INFO  --> Create user with username: [tme@spirographics.com] password: [sjQx05Oy] email: [tme@spirographics.com] 
2015-08-21 16:02:47 - ERROR --> Credit Card transaction error with authorize.net (3) Reason: 5 Response text - A valid amount is required. 
2015-08-21 16:02:47 - INFO  --> rollbackReturn called 
2015-08-21 16:02:47 - DEBUG --> Delete user: 94 
2015-08-21 16:05:36 - INFO  --> Credit Card type: Visa 
2015-08-21 16:05:36 - DEBUG --> Credit card last four digits: 1979 
2015-08-21 16:05:36 - DEBUG --> Credit card expiration date: 2016-11 
2015-08-21 16:05:36 - INFO  --> Create user with username: [tme@spirographics.com] password: [kWHYt1ss] email: [tme@spirographics.com] 
2015-08-21 16:05:38 - DEBUG --> Create user_subscription record with user_subscription_id: [92] 
2015-08-21 21:30:10 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-08-21 21:41:09 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-08-21 21:54:12 - INFO  --> Credit Card type: Visa 
2015-08-21 21:54:12 - DEBUG --> Credit card last four digits: 1979 
2015-08-21 21:54:12 - DEBUG --> Credit card expiration date: 2016-11 
2015-08-21 21:54:12 - INFO  --> Create user with username: [todd@spirographics.com] password: [ksflZBVC] email: [todd@spirographics.com] 
2015-08-21 21:54:14 - DEBUG --> Create user_subscription record with user_subscription_id: [93] 
2015-08-21 21:56:38 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-08-21 22:09:56 - INFO  --> Credit Card type: Visa 
2015-08-21 22:09:56 - DEBUG --> Credit card last four digits: 1979 
2015-08-21 22:09:56 - DEBUG --> Credit card expiration date: 2016-11 
2015-08-21 22:09:56 - INFO  --> Found user with user_id: 96 
2015-08-21 22:09:58 - DEBUG --> Create user_subscription record with user_subscription_id: [94] 
2015-08-24 17:59:46 - INFO  --> Credit Card type: Visa 
2015-08-24 17:59:46 - DEBUG --> Credit card last four digits: 1162 
2015-08-24 17:59:46 - DEBUG --> Credit card expiration date: 2017-02 
2015-08-24 17:59:46 - INFO  --> Found user with user_id: 66 
2015-08-24 17:59:48 - DEBUG --> Create user_subscription record with user_subscription_id: [95] 
2015-08-28 16:58:42 - INFO  --> Credit Card type: Visa 
2015-08-28 16:58:42 - DEBUG --> Credit card last four digits: 4213 
2015-08-28 16:58:42 - DEBUG --> Credit card expiration date: 2018-05 
2015-08-28 16:58:42 - INFO  --> Create user with username: [dvanhorn19@gmail.com] password: [AULDI9Ko] email: [dvanhorn19@gmail.com] 
2015-08-28 16:58:42 - DEBUG --> Create user_subscription record with user_subscription_id: [96] 
2015-08-28 16:58:44 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Fri, 28 Aug 2015 16:58:43 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-97</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25664603</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-28 20:27:50 - INFO  --> Credit Card type: MasterCard 
2015-08-28 20:27:50 - DEBUG --> Credit card last four digits: 3185 
2015-08-28 20:27:50 - DEBUG --> Credit card expiration date: 2017-09 
2015-08-28 20:27:50 - INFO  --> Create user with username: [jillian.l.french@gmail.com] password: [p4Uo1gmq] email: [jillian.l.french@gmail.com] 
2015-08-28 20:27:50 - DEBUG --> Create user_subscription record with user_subscription_id: [97] 
2015-08-28 20:27:52 - DEBUG --> HTTP/1.1 100 Continue

HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Fri, 28 Aug 2015 20:27:52 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-98</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25668276</subscriptionId></ARBCreateSubscriptionResponse> 
2015-08-29 19:43:02 - INFO  --> Credit Card type: Visa 
2015-08-29 19:43:02 - DEBUG --> Credit card last four digits: 1357 
2015-08-29 19:43:02 - DEBUG --> Credit card expiration date: 2018- 
2015-08-29 19:43:02 - ERROR --> Credit Card expdate error: 2018- 
2015-08-29 19:43:02 - INFO  --> rollbackReturn called 
2015-08-29 19:44:11 - INFO  --> Credit Card type: Visa 
2015-08-29 19:44:11 - DEBUG --> Credit card last four digits: 1357 
2015-08-29 19:44:11 - DEBUG --> Credit card expiration date: 2018-12 
2015-08-29 19:44:11 - INFO  --> Create user with username: [Nikminer@gmail.com] password: [zirbtczv] email: [Nikminer@gmail.com] 
2015-08-29 19:44:11 - DEBUG --> Create user_subscription record with user_subscription_id: [98] 
2015-08-29 19:44:12 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 425
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Sat, 29 Aug 2015 19:44:11 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-99</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25675318</subscriptionId></ARBCreateSubscriptionResponse> 
2015-09-06 19:33:02 - INFO  --> Credit Card type: Visa 
2015-09-06 19:33:02 - DEBUG --> Credit card last four digits: 1007 
2015-09-06 19:33:02 - DEBUG --> Credit card expiration date: 2018-06 
2015-09-06 19:33:02 - INFO  --> Create user with username: [cblehman11@gmail.com] password: [paBhCaQq] email: [cblehman11@gmail.com] 
2015-09-06 19:33:02 - DEBUG --> Create user_subscription record with user_subscription_id: [99] 
2015-09-06 19:33:04 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 426
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Sun, 06 Sep 2015 19:33:05 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-100</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25763127</subscriptionId></ARBCreateSubscriptionResponse> 
2015-09-06 20:16:40 - INFO  --> Credit Card type: American Express 
2015-09-06 20:16:40 - DEBUG --> Credit card last four digits: 2459 
2015-09-06 20:16:40 - DEBUG --> Credit card expiration date: 2018-09 
2015-09-06 20:16:40 - INFO  --> Create user with username: [daniel.davison08@gmail.com] password: [q9elThKm] email: [daniel.davison08@gmail.com] 
2015-09-06 20:16:40 - DEBUG --> Create user_subscription record with user_subscription_id: [100] 
2015-09-06 20:16:41 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 426
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Sun, 06 Sep 2015 20:16:41 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-101</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25763315</subscriptionId></ARBCreateSubscriptionResponse> 
2015-09-08 18:45:55 - INFO  --> Credit Card type: Visa 
2015-09-08 18:45:55 - DEBUG --> Credit card last four digits: 0591 
2015-09-08 18:45:55 - DEBUG --> Credit card expiration date: 2016-07 
2015-09-08 18:45:55 - INFO  --> Create user with username: [spowell06@gmail.com] password: [yt2EEVo1] email: [spowell06@gmail.com] 
2015-09-08 18:45:55 - DEBUG --> Create user_subscription record with user_subscription_id: [101] 
2015-09-08 18:45:57 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 426
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Tue, 08 Sep 2015 18:45:57 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-102</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25776861</subscriptionId></ARBCreateSubscriptionResponse> 
2015-09-09 19:53:41 - INFO  --> Credit Card type: Discover 
2015-09-09 19:53:41 - DEBUG --> Credit card last four digits: 3570 
2015-09-09 19:53:41 - DEBUG --> Credit card expiration date: 2016-03 
2015-09-09 19:53:41 - INFO  --> Create user with username: [cheryldipiero@cisinternet.net] password: [gRJTX1kn] email: [cheryldipiero@cisinternet.net] 
2015-09-09 19:53:41 - DEBUG --> Create user_subscription record with user_subscription_id: [102] 
2015-09-09 19:53:42 - DEBUG --> HTTP/1.1 100 Continue

HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 426
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Wed, 09 Sep 2015 19:53:43 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-103</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25791008</subscriptionId></ARBCreateSubscriptionResponse> 
2015-09-11 12:30:40 - INFO  --> Credit Card type: Visa 
2015-09-11 12:30:40 - DEBUG --> Credit card last four digits: 9152 
2015-09-11 12:30:40 - DEBUG --> Credit card expiration date: 2017-10 
2015-09-11 12:30:40 - INFO  --> Create user with username: [emacparker@yahoo.com] password: [ZDYpXWyg] email: [emacparker@yahoo.com] 
2015-09-11 12:30:40 - DEBUG --> Create user_subscription record with user_subscription_id: [103] 
2015-09-11 12:30:41 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 426
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Fri, 11 Sep 2015 12:30:41 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-104</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25809531</subscriptionId></ARBCreateSubscriptionResponse> 
2015-09-11 19:50:16 - INFO  --> Credit Card type: Visa 
2015-09-11 19:50:16 - DEBUG --> Credit card last four digits: 7726 
2015-09-11 19:50:16 - DEBUG --> Credit card expiration date: 2019-09 
2015-09-11 19:50:16 - INFO  --> Create user with username: [dodnavy74@verizon.net] password: [ww6iU5Cm] email: [dodnavy74@verizon.net] 
2015-09-11 19:50:18 - DEBUG --> Create user_subscription record with user_subscription_id: [104] 
2015-09-13 2:28:20 - INFO  --> Credit Card type: Visa 
2015-09-13 2:28:20 - DEBUG --> Credit card last four digits: 8486 
2015-09-13 2:28:20 - DEBUG --> Credit card expiration date: 2016-01 
2015-09-13 2:28:20 - INFO  --> Create user with username: [jpetrochko@gmai.com] password: [wyHX25Pf] email: [jpetrochko@gmai.com] 
2015-09-13 2:28:23 - DEBUG --> Create user_subscription record with user_subscription_id: [105] 
2015-09-21 10:16:04 - INFO  --> Credit Card type: Visa 
2015-09-21 10:16:04 - DEBUG --> Credit card last four digits: 7272 
2015-09-21 10:16:04 - DEBUG --> Credit card expiration date: 2016-01 
2015-09-21 10:16:04 - INFO  --> Create user with username: [bcrabtre@ida.org] password: [6OOXIn2j] email: [bcrabtre@ida.org] 
2015-09-21 10:16:05 - DEBUG --> Create user_subscription record with user_subscription_id: [106] 
2015-09-21 10:16:06 - DEBUG --> HTTP/1.1 200 OK
Cache-Control: private
Content-Length: 426
Content-Type: application/xml; charset=utf-8
Server: Microsoft-IIS/7.5
X-AspNet-Version: 2.0.50727
X-Powered-By: ASP.NET
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET,POST,OPTIONS
Access-Control-Allow-Headers: x-requested-with,cache-control,content-type,origin,method
Date: Mon, 21 Sep 2015 10:16:07 GMT

﻿<?xml version="1.0" encoding="utf-8"?><ARBCreateSubscriptionResponse xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="AnetApi/xml/v1/schema/AnetApiSchema.xsd"><refId>ORDER-108</refId><messages><resultCode>Ok</resultCode><message><code>I00001</code><text>Successful.</text></message></messages><subscriptionId>25900297</subscriptionId></ARBCreateSubscriptionResponse> 
2015-09-29 14:53:30 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-09-29 19:18:59 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2015-09-29 19:19:23 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-01-04 17:14:12 - INFO  --> Activating/Installing plugin 
2016-01-04 17:14:12 - INFO  --> Creating table: lder_authnet_user_subscription 
2016-01-04 17:14:12 - INFO  --> Table: lder_authnet_user_subscription already exists 
2016-01-04 17:14:12 - INFO  --> Creating table: lder_authnet_subscription 
2016-01-04 17:14:12 - INFO  --> Table: lder_authnet_subscription already exists 
2016-01-04 17:14:12 - INFO  --> Creating table: lder_authnet_payment 
2016-01-04 17:14:12 - INFO  --> Table: lder_authnet_payment already exists 
2016-01-04 17:14:12 - INFO  --> Creating table: lder_authnet_cancellation 
2016-01-04 17:14:12 - INFO  --> Table: lder_authnet_cancellation already exists 
2016-01-04 17:14:12 - DEBUG --> Page: checkout ready for creation/update 
2016-01-04 17:14:12 - INFO  --> Updating Page: checkout 
2016-02-08 18:27:00 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-02-10 16:05:10 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-02-10 18:33:25 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-02-26 22:02:13 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-05-02 14:53:34 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-06-09 15:23:57 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-08-28 18:31:57 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-08-29 14:33:20 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-09-08 15:05:20 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2016-09-08 15:15:33 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2017-06-14 22:50:49 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2018-02-08 10:26:36 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2018-02-08 10:48:05 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2018-02-08 10:51:15 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2018-04-02 15:17:21 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2018-04-02 15:18:30 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2018-04-02 15:19:16 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2019-05-15 15:25:20 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2019-06-24 18:50:29 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2019-06-24 19:22:17 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2019-10-30 16:42:30 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2019-10-30 21:02:36 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2019-11-18 23:07:54 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
2019-11-20 23:00:28 - DEBUG --> SELECT * FROM lder_authnet_subscription ORDER BY ID ASC 
