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
  `case_bidding_start` DATETIME NOT NULL,
  `case_bidding_end` DATETIME NOT NULL,
  PRIMARY KEY (`case_id`),
  UNIQUE INDEX `case_trade_number_UNIQUE` (`case_trade_number` ASC) VISIBLE,
  UNIQUE INDEX `case_lot_UNIQUE` (`case_lot` ASC) VISIBLE);

  ALTER TABLE `nistpRu`.`case` 
      DROP COLUMN `case_number`;
      ALTER TABLE `nistpRu`.`case` 
ADD COLUMN `case_information` TEXT NOT NULL AFTER `case_url`,
CHANGE COLUMN `case_bidding_end` `case_information` DATETIME NOT NULL ;



  INSERT INTO `case` (`case_trade_number`,`case_lot`,`case_url`,`case_initail_price`,`case_contact_email`,`case_contact_phone`,`case_debtor_inn`,`case_debtor_number`,`case_bidding_start`,`case_bidding_end`,`case_information`)
                      VALUES (
                        "41245-ОАОФ",
                        "1",
                        "https://nistp.ru/bankrot/trade_list.php?trade_number=41212-ОТПП&lot_number=1",
                        "350000.00",
                        "olesi02@mail.ru",
                        "+79025612659",
                        "246502840929",
                        "А19-17285/2022",
                        "26.03.2024 09:00:00",
                        "02.05.2024 15:00:00",
                        "Земельный участок в Красноярском Крае"
                      ); 
-- проверка на изменение таблицы
UPDATE `case` SET case_trade_number = '41249-ОАОФ',case_lot = 1,case_url = 1,case_initail_price = 1,case_contact_email = 1,case_contact_phone= 1,case_debtor_inn = 1,case_debtor_number = 1,case_bidding_start = 1,case_bidding_end = 1,case_information = 1 WHERE case_trade_number = '41249-ОАОФ';