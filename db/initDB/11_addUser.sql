-- ----------------------------
-- Create database and default data for "www.colour.name".
-- 2018-12-01 phi@gress.ly
--

USE               `farbnamen` ;
SET NAMES         'utf8'      ;
SET CHARACTER SET 'utf8'      ;

-- create default user for development
-- CHANGE FOR REAL PRODUCTIVE SYSTEM!
GRANT SELECT, INSERT ON `farbnamen`.* TO 'coloresV4'@'%' IDENTIFIED BY '123';
