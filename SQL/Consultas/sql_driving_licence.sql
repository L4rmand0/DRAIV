SELECT 
Driving_licence.Licence_num, 
Driving_licence.Country_expedition, 
Driving_licence.Category, 
Driving_licence.State, 
Driving_licence.Expedition_day, 
Driving_licence.Expi_date,
User_information.First_name,
User_information.F_last_name
FROM sam.Driving_licence 
INNER JOIN User_information on User_information.DNI_id = Driving_licence.User_information_DNI_id 
WHERE User_information.Company_id = '9013380301';

SELECT * FROM company;