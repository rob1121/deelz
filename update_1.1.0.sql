/**
** BANK INFORMATIONS FOR PROs
**/
ALTER TABLE  `users_pro` ADD  `bank_company` VARCHAR( 255 ) NOT NULL AFTER  `informations` ,
ADD  `bank_name` VARCHAR( 255 ) NOT NULL AFTER  `bank_company` ,
ADD  `bank_address` VARCHAR( 400 ) NOT NULL AFTER  `bank_name` ,
ADD  `bank_iban` VARCHAR( 255 ) NOT NULL AFTER  `bank_address` ,
ADD  `bank_bic` VARCHAR( 255 ) NOT NULL AFTER  `bank_iban` ,
ADD  `paypal_account` VARCHAR( 255 ) NOT NULL AFTER  `bank_bic`