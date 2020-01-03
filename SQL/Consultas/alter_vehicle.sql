#DELETE FROM user_vehicle;
#DELETE FROM vehicle;

ALTER TABLE `vehicle`
	ADD COLUMN `company_id` BIGINT(12) UNSIGNED NOT NULL DEFAULT 1 AFTER `version`;

ALTER TABLE vehicle
ADD FOREIGN KEY (company_id) REFERENCES company(company_id);
