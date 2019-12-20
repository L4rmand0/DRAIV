
SELECT * FROM	sam.admin_country;

SELECT DISTINCT admin1, adm1_id FROM sam.Admin_Country;

SELECT DISTINCT adm2_id, admin2, adm1_id FROM sam.Admin_Country;

SELECT DISTINCT adm3_id, admin3, adm2_id FROM sam.Admin_Country;


SELECT * FROM admin1;

SELECT * FROM admin2;

SELECT * FROM admin3;



INSERT INTO admin1 (
    adm1_id, 
    name
)
SELECT DISTINCT adm1_id, admin1 FROM sam.admin_country;

INSERT INTO admin2 (
    adm2_id, 
    name,
    adm1_id 
)
SELECT DISTINCT adm2_id, admin2, adm1_id FROM sam.admin_country;


INSERT INTO admin3 (
    adm3_id, 
    name,
    adm2_id 
)
SELECT DISTINCT adm3_id, admin3, adm2_id FROM sam.admin_country;








