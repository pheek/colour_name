-- --------------------------------------
USE                         `farbnamen` ;
SET NAMES         'utf8';
SET CHARACTER SET 'utf8';

-- --------------------------------------
CREATE VIEW vw_nomination AS

SELECT
 `nomination`.`ID`       AS id_nomination  ,
 `farbnamen` .`ID`       AS colournameID   ,
 `farbnamen` .`Name`     AS colourname     ,
 `nomination`.`Zeit`     AS zeitstempel    ,
 `sprache`   .`ID`       AS lang           ,
 `netzhaut`  .`ID`       AS netzhaut       ,
 `begriffN`  .`Kuerzel`  AS netzhautBegriff,
 `medium`    .`ID`       AS medium         ,
 `begriffM`  .`Kuerzel`  AS mediumBegriff  ,
 `nomination`.`F_rgb`    AS id_rgb         ,
 `rgb`.`R`, `rgb`.`G`, `rgb`.`B`
FROM `nomination`
LEFT JOIN `rgb`                  ON `nomination`.`F_rgb`       = `rgb`      .`ID`
LEFT JOIN `farbnamen`            ON `nomination`.`F_farbnamen` = `farbnamen`.`ID`
LEFT JOIN `sprache`              ON `nomination`.`F_sprache`   = `sprache`  .`ID`
LEFT JOIN `netzhaut`             ON `nomination`.`F_netzhaut`  = `netzhaut` .`ID`
LEFT JOIN `medium`               ON `nomination`.`F_medium`    = `medium`   .`ID`
LEFT JOIN `begriff` AS begriffM  ON `medium`    .`F_begriff`   = `begriffM` .`ID` 
LEFT JOIN `begriff` AS begriffN  ON `netzhaut`  .`F_begriff`   = `begriffN` .`ID` 
;
