-- --------------------------------------
USE               `farbnamen` ;
SET NAMES         'utf8'      ;
SET CHARACTER SET 'utf8'      ;

CALL sp_insertNomination('rötlich'   , 1234567890, 140, 110, 110, 1, 1, '2018-12-14 08:44:55', 'de', @dummy);
CALL sp_insertNomination('grünlich'  , 1244567890, 110, 140, 110, 1, 1, '2018-12-14 08:44:56', 'de', @dummy);
CALL sp_insertNomination('bläulich'  , 1235567890, 110, 110, 140, 1, 2, '2018-12-14 08:44:57', 'de', @dummy);
CALL sp_insertNomination('cyan'      , 1234667890,   0, 255, 255, 2, 1, '2018-12-14 08:44:58', 'en', @dummy);
CALL sp_insertNomination('yellow'    , 1234577890, 200, 200,  10, 2, 1, '2018-12-14 08:44:59', 'en', @dummy);
CALL sp_insertNomination('black'     , 1234568890,   0,  10,  12, 2, 1, '2018-12-14 08:45:00', 'en', @dummy);
CALL sp_insertNomination('jaune'     , 1234567990, 250, 253,  18, 1, 1, '2018-12-14 08:45:01', 'fr', @dummy);
CALL sp_insertNomination('bleu'      , 1334567800,  11,   5,  90, 2, 1, '2018-12-14 08:45:02', 'fr', @dummy);
CALL sp_insertNomination('blau'      , 1244567800,  11,   5, 190, 2, 1, '2018-12-14 08:45:03', 'de', @dummy);
CALL sp_insertNomination('grün'      , 1234567800,  44,  88,   2, 1, 1, '2018-12-14 08:45:04', 'de', @dummy);
CALL sp_insertNomination('dunkelgrün', 1234566800,  44,  88,   2, 2, 1, '2018-12-14 08:45:04', 'de', @dummy);

CALL sp_insertNomination('rouge'     , 1234566800, 255,   0,   0, 2, 1, '2018-12-14 08:45:04', 'fr', @dummy);
CALL sp_insertNomination('bleu'      , 1274566800,   0, 255,   0, 1, 1, '2018-12-14 08:45:04', 'fr', @dummy);
CALL sp_insertNomination('vert foncé', 1237566800,  44,  88,   2, 2, 1, '2018-12-14 08:45:04', 'fr', @dummy);
