CREATE DATABASE IF NOT EXISTS nistpRu CHARACTER SET utf8 COLLATE utf8_general_ci;
USE nistpRu;
CREATE TABLE `nistpRu`.`case` (
  `case_id` INT NOT NULL AUTO_INCREMENT,
  `case_trade_number` VARCHAR(45) NOT NULL,
  `case_lot` VARCHAR(45) NOT NULL,
  `case_url` TEXT NOT NULL,
  `case_initail_price` VARCHAR(45) NOT NULL,
  `case_contact_email` VARCHAR(150) NOT NULL COMMENT '	',
  `case_contact_phone` VARCHAR(13) NOT NULL,
  `case_debtor_INN` VARCHAR(45) NOT NULL,
  `case_debtor_number` VARCHAR(45) NOT NULL,
  `case_bidding_start` VARCHAR(45) NOT NULL,
  `case_bidding_end` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`case_id`),
  UNIQUE INDEX `case_trade_number_UNIQUE` (`case_trade_number` ASC) VISIBLE,
  UNIQUE INDEX `case_lot_UNIQUE` (`case_lot` ASC) VISIBLE);
