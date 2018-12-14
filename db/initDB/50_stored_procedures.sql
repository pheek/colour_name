-- --------------------------------------
USE                         `farbnamen` ;
SET NAMES         'utf8';
SET CHARACTER SET 'utf8';


-- 2018-08-07 phi@gress.ly
--
-- Insert values into dynamic table.
-- If the element already existed, nothing will be inserted, but the old
-- id is "returned" (OUT-Param).
-- If "_reuse_if_exists" is unset (FALSE), then a new element is
-- generated anyway
-- Otherwise a new row is generated.
DELIMITER //
CREATE PROCEDURE SP_insert_and_get_ID
( IN  _tabellenName    TEXT
, IN  _attributName    TEXT
, IN  _attributWert    TEXT
, IN  _reuse_if_exists BOOLEAN
, OUT _id              INT
)
MODIFIES SQL DATA
BEGIN
	SET @tmpID    := -1; -- Any number which is not in the DB.
	
	SET @tmpQuery := CONCAT('SELECT `ID` INTO @tmpID',
	                        ' FROM ' , _tabellenName,
	                        ' WHERE ', _attributName, ' = "', _attributWert, '"', " LIMIT 1" );
	PREPARE stmt FROM @tmpQuery;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;

	-- -1 != @tmpID means: an entry has been found. So, -1 = @tmpID means: INSERT anyway
	-- IF not found or "create new" (wher "create new" is identical to "NOT reuse").
	IF ((-1 = @tmpID) OR (NOT _reuse_if_exists)) THEN
		SET @tmpQuery := CONCAT('INSERT INTO ', '`', _tabellenName , '`',
		                        '(`', _attributName, '`) VALUES',
		                        '("', _attributWert, '")'
		                       );
		PREPARE stmt FROM @tmpQuery;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
		SET @tmpID := LAST_INSERT_ID();
	END IF;

	SET _id := @tmpID;
END; //
DELIMITER ;


-- --------------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS sp_insertNominaton;
DELIMITER //
CREATE PROCEDURE sp_insertNomination
( IN  _colourName TEXT
, IN  _ip         INTEGER
, IN  _R          TINYINT unsigned
, IN  _G          TINYINT unsigned
, IN  _B          TINYINT unsigned
, IN  _Netzhaut   INTEGER
, IN  _Medium     INTEGER
, IN  _When       DATETIME
, IN  _Sprache    VARCHAR(3)
, OUT _insertID   INTEGER
)
MODIFIES SQL DATA
BEGIN
	DECLARE tmpNameID INTEGER;
	DECLARE tmpIpV4ID INTEGER;
	DECLARE tmpRGBID  INTEGER;

--	SET @tmpNameID := -1;
--	SET @tmpIpV4ID := -1;
--	SET @tmpRGBID  := -1;
		
	CALL SP_insert_and_get_ID('farbnamen', 'name' , _colourName, TRUE, tmpNameID);
	CALL SP_insert_and_get_ID('ipV4'     , 'v4Int', _ip        , TRUE, tmpIpV4ID);

	SET tmpRGBID := -1;
	SELECT `ID` INTO tmpRGBID FROM `rgb` WHERE `R` = _R AND `G` = _G AND `B` = _B;

	if(-1 = tmpRGBID) THEN
		INSERT INTO `rgb` (`R`, `G`, `B`) VALUES (_R, _G, _B);
 		SET tmpRGBID = LAST_INSERT_ID();
	END IF;

	INSERT INTO `nomination`
	(`F_rgb`  , `F_farbnamen`, `F_netzhaut`, `F_medium`, `F_ipV4`  , `Zeit`, `F_sprache`) VALUES
	(tmpRGBID, tmpNameID   , _Netzhaut   , _Medium   , tmpIpV4ID, _When, _Sprache );

	SET _insertID = LAST_INSERT_ID();
END; //

DELIMITER ;
