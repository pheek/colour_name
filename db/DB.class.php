<?php

require_once __DIR__ . '/../_lang/LangBundle.class.php';

class DB {

  private $connection;
  
  private static $hostname = 'localhost';
  private static $username = 'coloresV4';
  private static $password = '123';
  private static $dbname   = 'farbnamen';

  // constructor und "connect"
  function __construct() {
    error_reporting(E_ALL); 
    
    $this->connection = mysqli_connect(self::$hostname, self::$username, self::$password) or die ("Verbindung lokal fehlgeschlagen. S. /db/DB.class.php!");
    mysqli_select_db($this->connection, self::$dbname) or die ("use db (local) fails!"); 
    $this->insert("SET NAMES 'utf8'") or die ("query utf fails");
  }

  //DEBUG 
  public function toString() {
    if($this->connection) {
      return "DB active: " . DB::$dbname . "<br/>\n";
    } else {
      return "DB NOT ACTIVE connected!<br/>";
    }
  }

  /****************** F U N C T I O N S ********************/

  /**
   * Replaces "#LANG#' by the actual language.
   */
  private function langReplacer($sql, $lang) {
    global $TPL_LANG;
    if("" == $lang) {
      $lang = $TPL_LANG->getLanguage();
    }
    $select = str_replace("#LANG#", $lang, $sql);
    return $select;
  }

  /**
   * Ausführen eines SELECT, das von der aktuellen Sprache abhängig ist.
   * An die Stelle der Sprache ist #LANG# einzusetzen.
   * Zurückgegeben wird das $result
   */
  public function getLangSelectResult($select, $lang = "") {
    $select = $this->langReplacer($select, $lang); 
    return $this->select($select);
  }

  public function select($sql) {
    $result = mysqli_query($this->connection, $sql);
    return $result;
  }

  /**
   * SQL Insert statement. Make sure, it is already escaped!
   * @param type $sql
   * @return type 
   */
  public function insert($sql) {
    return mysqli_query($this->connection, $sql);
  }

  /**
   * Ausführen eines SELECT, das genau einen Wert zurückgibt. #LANG# wird 
   * entweder durch die aktuelle Sprache oder durch den 2. Parameter ersetzt.
   * 
   * @param type $select statment, das einen Platzhalter "#LANG#" enthält.
   * @param type $lang entweder kann die Sprache gesetzt sein, oder dieser Parameter ist 
   * @return Einziger Wert des Select Statements.
   */
  public function getLangSelectValue($select, $lang = "") {
    $sel = $this->langReplacer($select, $lang);
    //    echo "DEBUG DB.class.php getLangSelectValue sql=" . $sel . "<br />\n";
    return $this->getSelectValue($sel);
  }
  /**
   * same, but without being depandent on a language.
   */
  public function getSelectValue($select) {
    $result = $this->select($select);
    if (0 >= mysqli_num_rows($result)) {
      return -1; 
    }
    $val = mysqli_data_seek($result, 0);
    $row=mysqli_fetch_row($result);
    return $row[0]; // was $val here
  }


	
  /**
   * Insert into table and get the inserted ID. 
   * This is necessary at AUTO-INCREMENT Tables (which are all in "www.colur.name").
   * @param $insertStatement is something like "INSERT INTO mytable (...) VALUES (...);"
   *                         There is only ONE insertet row.
   * @param $tabel           The name of "mytable" (redundant, because already in the $insertStatement)
   */
  public function insertAndGetInsertedID($insertStatement, $table) {
    $this->insert("START TRANSACTION");
    $this->insert($insertStatement);
    $result = $this->select("SELECT MAX(ID) AS LAST_ID FROM " . $table);
    $result = mysqli_fetch_array($result);
    $this->insert("COMMIT");
    $lastID = $result['LAST_ID'];
    return $lastID;
  }

} // end of class "DB"

/////////////////////////////////////////////////////////////////

// use as singleton:
global $TPL_DB;
if(!isset ($TPL_DB)) {
  $TPL_DB = new DB();
}

?>