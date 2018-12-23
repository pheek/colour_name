-- ----------------------------
-- Create database and default data for "www.colour.name".
-- 2018-12-01 phi@gress.ly
--
-- --------------------------------------
USE               `farbnamen` ;
SET NAMES         'utf8'      ;
SET CHARACTER SET 'utf8'      ;


-- 2018-08-07 phi@gress.ly
--
-- Insert dynamiclally values into a table.
-- If the element already existed, nothing will be inserted, but the old
-- id is "returned" (OUT-Param); otherwise a new row is generated.
-- If "_reuse_if_exists" is unset (FALSE), then a new element is
-- generated anyway.
-- this works for tables having an ID and a single attribute
-- of type text.
DELIMITER //
CREATE PROCEDURE sp_insert_and_get_ID
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


-- --------------------------------------
-- Insert a nomination into the table `nomination`.
-- This would be nothing spcial; but this stored procedure adds the
--  * `name`           into `farbnamen`, iff it did not already exist,
--  * `v4Int`          into `ipV4'     , iff it did not already exist and
--  * `R`, `G` and `B` into `rgb`      , iff it did not already exist (as triple).
-- Only the mentioned foreign keys (`_F_...`) must be known before
-- you call this method:
-- * _F_Netzhaut  eg 1
-- * _F_Medium    eg 2
-- * _F_Sprache   eg "fr"
-- Returns the id of the newly created nomination "object".
DROP PROCEDURE IF EXISTS sp_insertNominaton;
DELIMITER //
CREATE PROCEDURE sp_insertNomination
( IN  _colourName   TEXT
, IN  _ip           INTEGER
, IN  _R            TINYINT unsigned
, IN  _G            TINYINT unsigned
, IN  _B            TINYINT unsigned
, IN  _F_Netzhaut   INTEGER
, IN  _F_Medium     INTEGER
, IN  _When         DATETIME
, IN  _F_Sprache    VARCHAR(3)
, OUT _insertID     INTEGER
)
MODIFIES SQL DATA
BEGIN
	CALL sp_insert_and_get_ID('farbnamen', 'name' , _colourName, TRUE, @tmpNameID);
	CALL sp_insert_and_get_ID('ipV4'     , 'v4Int', _ip        , TRUE, @tmpIpV4ID);

	SET @tmpRGBID := -1;
	SELECT `ID` INTO @tmpRGBID FROM `rgb` WHERE `R` = _R AND `G` = _G AND `B` = _B;

	if(-1 = @tmpRGBID) THEN
		INSERT INTO `rgb` (`R`, `G`, `B`) VALUES (_R, _G, _B);
		SET @tmpRGBID = LAST_INSERT_ID();
	END IF;

	INSERT INTO `nomination`
	 (`F_rgb`   , `F_farbnamen`, `F_netzhaut`, `F_medium`, `F_ipV4`   , `Zeit`, `F_sprache`) VALUES
	 ( @tmpRGBID,  @tmpNameID  , _F_Netzhaut , _F_Medium ,  @tmpIpV4ID, _When , _F_Sprache );

	SET _insertID = LAST_INSERT_ID();
END; //

DELIMITER ;
