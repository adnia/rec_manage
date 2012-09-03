<?php
	/* Store database connection information
	 * NOTE: This way is not secure - it is done this way in order to
	 *       have easy access to a development database. If you are
	 *       going to deploy any system, you must store this data in
	 *       a more secure way!
	 */
	define("DB_HOST", "sqlite:/var/www/bons/db.sqlite");
	
	/** User table */
	define("TABLE_USERS", "users");
	/** shop table */
	define("TABLE_CLIENTS", "shops");
	/** Receipt table */
	define("TABLE_TPS", "receipts");

	/**
	 * Connects to the database and returns the handler.
	 * 
	 * @return The database handler
	 */
	function dbConnect() {
		try {
			$dbh = new PDO(DB_HOST, DB_USER, DB_PASS);
		} catch (PDOException $e) {
			die($e);
		}
	}

	/**
	 * Install needed tables if not existing
	 */
	function installTables() {
		$sql = "
			CREATE TABLE IF NOT EXISTS ".TABLE_USERS." (
				uid               varchar(3)      NOT NULL PRIMARY KEY,
				name              varchar(40)     NOT NULL,
				surname           varchar(40)     NOT NULL,
				email             varchar(100)    DEFAULT NULL,
				password          varchar(32)     DEFAULT NULL
			);
		";

		$sql = "
			CREATE TABLE IF NOT EXISTS ".TABLE_SHOPS." (
				sid               varchar(3)      NOT NULL PRIMARY KEY,
				name              varchar(40)     NOT NULL
			);
		";

		$sql = "
			CREATE TABLE IF NOT EXISTS ".TABLE_RECEIPTS." (
				rid_local         int             NOT NULL,
				FOREIGN KEY(uid)                  REFERENCES ".TABLE_USERS."(uid),
				FOREIGN KEY(sid)                  REFERENCES ".TABLE_SHOPS."(sid),
				cash_value        decimal(6,2)    NOT NULL,
				buy_date          date            NOT NULL,
				payback_date      date            DEFAULT NULL,
				PRIMARY KEY(sid, uid, rid_local)
			);
		";
	}
	
	/** Global database handler */
	$dbh = NULL;

?>
