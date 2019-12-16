SELECT 
User_information.DNI_id,
User_information.First_name,
User_information.Second_name,
User_information.F_last_name,
User_information.S_last_name,
User_information.Gender,
User_information.Education,
User_information.E_mail_address,
User_information.address,
User_information.Country_born,
User_information.City_Residence_place,
admin2.name AS Department,
admin3.name AS City_born,
User_information.phone,
User_information.Civil_state,
User_information.Score,
users.name AS user, 
company.Name_company AS company
FROM sam.users
INNER JOIN sam.User_information ON User_information.Db_user_id = users.id
INNER JOIN sam.company ON company.Company_id = User_information.Company_id
INNER JOIN sam.admin2 ON admin2.adm2_id = User_information.Department
INNER JOIN sam.admin3 ON admin3.adm3_id = User_information.City_born;