 SELECT * FROM sam.driver_information;
 
 select driver_information.DNI_id,
            driver_information.first_name,
            driver_information.second_name,
            driver_information.f_last_name,
            driver_information.s_last_name,
            IF(driver_information.gender=1,"Masculino","Femenino") as Gender,
            driver_information.education,
            driver_information.e_mail_address,
            driver_information.address,
            driver_information.country_born,
            admin3.name AS city_born,
            driver_information.city_residence_place,
            admin2.name AS department,
            driver_information.phone,
            driver_information.civil_state,
            driver_information.score,
            driver_information.db_user_id,
            driver_information.company_id,
            users.name as user,
            company.Name_company as company from `driver_information` 
				inner join `users` on `driver_information`.`Db_user_id` = `users`.`id` 
				inner join `company` on `company`.`Company_id` = `driver_information`.`company_id` 
				inner join `admin2` on `admin2`.`adm2_id` = `driver_information`.`department` 
				inner join `admin3` on `admin3`.`adm3_id` = `driver_information`.`city_born` where `driver_information`.`company_id` is null and `driver_information`.`operation` != 'D'