DELIMITER $$

CREATE FUNCTION dominio_email(email VARCHAR(50))
RETURNS VARCHAR(50)
DETERMINISTIC
BEGIN
    RETURN SUBSTRING_INDEX(email, '@', -1);
END $$

DELIMITER ;

DROP VIEW IF EXISTS vwUserAnalytics;

CREATE VIEW vwUserAnalytics AS
SELECT 
    id,
    usuario,
    email,
    dominio_email(email) AS dominio,
    LENGTH(password) AS tamanho_senha,
    CASE
        WHEN dominio_email(email) LIKE '%gmail.com' THEN 'Gmail'
        WHEN dominio_email(email) LIKE '%hotmail.com' THEN 'Hotmail'
        WHEN dominio_email(email) LIKE '%outlook.com' THEN 'Outlook'
        ELSE 'Outro'
    END AS tipo_email
FROM tbUser;

select * from vwUserAnalytics;
