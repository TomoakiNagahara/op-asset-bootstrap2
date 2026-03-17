<?php
/**	op-asset-bootstrap2:/include/session.php
 *
 * @genesis    ????-??-??  op-app-skeleton:/app.php
 * @rebirth    2025-06-11  op-asset-bootstrap2:/include/root.php
 * @version    1.0
 * @package    op-asset-bootstrap2
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	Check if the current mode is CLI.
 *
 */
if( PHP_SAPI === 'cli' ){
	//	Currently in CLI mode.
	return;
}

/**	Check if the session has started.
 *
 */
if( session_id() ){
	//	The session has already been started.
	return;
}

/**	Start the session.
 *
 */
if( session_start() ){
	//	No problem!
	return;
}

/**	Switch by the session save handler.
 *
 */
switch( ini_get('session.save_handler') ){
	case 'memcached':
		//	Check if the memcached extension is loaded.
		if(!extension_loaded('memcached') ){
			$message = 'The memcached extension is not loaded.';
		}
	break;

	default:
		$message = 'Could not start the session.';
}

/**	Default error message.
 *
 */
$line = __LINE__;
$file = __FILE__;
echo "{$file} #{$line} - {$message}".PHP_EOL;
exit(__LINE__);
