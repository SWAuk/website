CREATE TABLE IF NOT EXISTS `#__swa_member` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11)  NOT NULL ,
  `paid` TINYINT(1)  NOT NULL DEFAULT 0,
  `club_committee` TINYINT(1)  NOT NULL DEFAULT 0,
  `swa_committee` TINYINT(1)  NOT NULL DEFAULT 0,
  `sex` VARCHAR(255)  NOT NULL DEFAULT 'None' ,
  `dob` DATE NOT NULL DEFAULT '0000-00-00',
  `university_id` INT(11)  NOT NULL ,
  `course` VARCHAR(100)  NOT NULL ,
  `graduation` INT(11)  NOT NULL ,
  `discipline` VARCHAR(50)  NOT NULL ,
  `level` VARCHAR(20)  NOT NULL DEFAULT 'Beginner',
  `shirt` VARCHAR(3)  NOT NULL ,
  `econtact` VARCHAR(255)  NOT NULL ,
  `enumber` VARCHAR(255)  NOT NULL ,
  `dietary` VARCHAR(10),
  `tel` VARCHAR(15) NOT NULL ,
  `swahelp` VARCHAR(50)  NOT NULL DEFAULT 'None',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC),
  INDEX `fk_member_user_idx` (`user_id` ASC),
  INDEX `fk_member_university_idx` (`university_id` ASC)
)
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_qualification` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `member_id` INT(11)  NOT NULL ,
  `type` VARCHAR(50)  NOT NULL ,
  `expiry_date` DATE NOT NULL ,
  PRIMARY KEY (`id`),
  INDEX `fk_qualification_member_idx` (`member_id` ASC)
)
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_university` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(200) NOT NULL ,
  `url` VARCHAR(200) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `name_UNIQUE` (`name` ASC)
)
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_university_member` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `member_id` INT(11)  NOT NULL ,
  `university_id` INT(11)  NOT NULL ,
  `graduated` TINYINT(1)  NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_university_member_member_idx` (`member_id` ASC),
  INDEX `fk_university_member_university_idx` (`member_id` ASC)
)
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_season` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `year` VARCHAR(4) NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `year_UNIQUE` (`year` ASC)
)
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_deposit` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `university_id` INT NOT NULL ,
  `date` DATE NOT NULL ,
  `amount` DECIMAL NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_deposit_university_idx` (`university_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_event` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(100) NOT NULL ,
  `season_id` INT NOT NULL ,
  `capacity` INT NOT NULL ,
  `date_open` DATE NOT NULL ,
  `date_close` DATE NOT NULL ,
  `date` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_event_season1_idx` (`season_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_event_host` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `event_id` INT NOT NULL ,
  `university_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_event_host_event1_idx` (`event_id` ASC) ,
  INDEX `fk_event_host_university1_idx` (`university_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_event_ticket` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `event_id` INT NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  `quantity` INT NOT NULL ,
  `price` DECIMAL NOT NULL ,
  `need_swa` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `need_xswa` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `need_host` TINYINT(1)  NOT NULL DEFAULT 0 ,
  `need_qualification` TINYINT(1)  NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_event_ticket_event1_idx` (`event_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_grant` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `event_id` VARCHAR(45) NOT NULL ,
  `application_date` DATE NOT NULL ,
  `amount` DECIMAL NOT NULL ,
  `fund_use` VARCHAR(255) NOT NULL ,
  `instructions` VARCHAR(255) NOT NULL ,
  `ac_sortcode` VARCHAR(8) NULL ,
  `ac_number` VARCHAR(8) NULL ,
  `ac_name` VARCHAR(200) NULL ,
  `finances_date` DATE NULL ,
  `finances_id` INT NULL ,
  `auth_date` DATE NULL ,
  `auth_id` INT NULL ,
  `payment_date` DATE NULL ,
  `payment_id` INT NULL ,
  `created_by` INT(11)  NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_grants_createdby1_idx` (`created_by` ASC) ,
  INDEX `fk_grants_event1_idx` (`event_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_ticket` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `member_id` INT NOT NULL ,
  `event_ticket_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_ticket_event_ticket1_idx` (`event_ticket_id` ASC) ,
  INDEX `fk_ticket_member1_idx` (`member_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_event_registration` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `event_id` INT NOT NULL ,
  `member_id` INT NOT NULL ,
  `expires` DATE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_event_registration_event1_idx` (`event_id` ASC) ,
  INDEX `fk_event_registration_member1_idx` (`member_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_competition_type` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_competition` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `event_id` INT NOT NULL ,
  `competition_type_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_competition_event1_idx` (`event_id` ASC) ,
  INDEX `fk_competition_competition_type1_idx` (`competition_type_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_indi_result` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `member_id` INT NOT NULL ,
  `competition_id` INT NOT NULL ,
  `result` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_indi_result_competition1_idx` (`competition_id` ASC) ,
  INDEX `fk_indi_result_member1_idx` (`member_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_team_result` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `competition_id` INT NOT NULL ,
  `university_id` INT NOT NULL ,
  `team_number` INT NOT NULL ,
  `result` INT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_team_result_competition1_idx` (`competition_id` ASC) ,
  INDEX `fk_team_result_university1_idx` (`university_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `#__swa_damages` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `event_id` INT NOT NULL ,
  `university_id` INT NOT NULL ,
  `date` DATE NOT NULL ,
  `cost` DECIMAL NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_damages_event1_idx` (`event_id` ASC) ,
  INDEX `fk_damages_university1_idx` (`university_id` ASC) )
DEFAULT COLLATE=utf8_general_ci;