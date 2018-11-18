-- Add the extra columns to the membership table
ALTER TABLE `#__swa_membership`
	ADD CONSTRAINT `unique_member_id_season_id` UNIQUE (`member_id`, `season_id`),
  DROP PRIMARY KEY,
	ADD COLUMN `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST,
  ADD COLUMN `paid` TINYINT(1) NOT NULL DEFAULT 0 AFTER `season_id`,
  ADD COLUMN `level` varchar(20) NOT NULL AFTER `paid`,
  ADD COLUMN `uni_id` int(11) NOT NULL AFTER `level`,
  ADD COLUMN `approved` TINYINT(1) NOT NULL DEFAULT 0 AFTER `uni_id`,
  ADD COLUMN `committee` varchar(20) DEFAULT NULL AFTER `approved`;

-- Update the members currently in the membership table
-- Members in this table have already paid their yearly membership fee
UPDATE `#__swa_membership` AS `membership`
LEFT JOIN `#__swa_member` AS `member` ON `member`.`id` = `membership`.`member_id`
LEFT JOIN `#__swa_university_member` AS `uni_member` ON `uni_member`.`member_id` = `membership`.`member_id`
SET `membership`.`paid`      = 1,
    `membership`.`level`     = `member`.`level`,
    -- if not in uni_member table set from member table
    `membership`.`uni_id`    = IF(`uni_member`.`university_id` IS NULL, `member`.`university_id`, `uni_member`.`university_id`),
    -- if set from uni_member table they've been approved, if from member table they've not been approved
    `membership`.`approved`  = IF(`uni_member`.`university_id` IS NULL, 0, 1),
    -- change old committee status of "0" or "" to NULL - otherwise use as is
    `membership`.`committee` = IF(`uni_member`.`committee` IN ("0", ""), NULL, `uni_member`.`committee`);

-- Insert members from university_member table into the membership table
-- Members in the university_member table but not in the membership table are lifetime members or haven't bought SWA membership
INSERT INTO `#__swa_membership` (`member_id`, `season_id`, `paid`, `level`, `uni_id`, `approved`, `committee`)
SELECT `member`.`id` AS `member_id`,
    -- set the season_id to this season
    18 AS `season_id`,
    -- paid their SWA Membership - all 0 as they will already be in the membership table with 1 or got lifetime membership
    0 AS `paid`,
    -- get member's level
    `member`.`level` AS `level`,
    -- get uni_id from uni_member table
    IF(`uni_member`.`university_id` IS NULL, `member`.`university_id`, `uni_member`.`university_id`) AS `uni_id`,
    -- is the member approved in the uni? 0/false if it's not in the uni_member table or graduated flag is 1
    IF(`uni_member`.`university_id` IS NULL OR `uni_member`.`graduated` = 1, 0, 1) AS `approved`,
    -- change old committee status of "0" or "" to NULL - otherwise use as is
    IF(`uni_member`.`committee` IN ("0", ""), NULL, `uni_member`.`committee`) AS `committee`
FROM `#__swa_member` AS `member`
LEFT JOIN `#__swa_university_member` AS `uni_member` ON `uni_member`.`member_id` = `member`.`id`
LEFT JOIN `#__swa_membership` AS `membership` ON `membership`.`member_id` = `member`.`id`
-- only select the members that aren't already in the membership table
WHERE `membership`.`member_id` IS NULL
-- and aren't graduated
AND `uni_member`.`graduated` != 1;
-- TODO: add only people that went to an event this year?


ALTER TABLE `#__swa_member`
  DROP COLUMN `dob`,
  DROP COLUMN `university_id`,
  DROP COLUMN `course`,
  DROP COLUMN `graduation`,
  DROP COLUMN `discipline`,
  DROP COLUMN `level`,
  DROP COLUMN `shirt`,
-- TODO: Drop dietary? Can add it as a ticket addon?
--	DROP COLUMN `dietary`,
  DROP COLUMN `swahelp`;

DROP TABLE `#__swa_university_member`;
