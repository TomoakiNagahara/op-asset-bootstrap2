<?php
/**	op-asset-bootstrap2:/include/rewrite.php
 *
 * @created    2025-07-08
 * @version    1.0
 * @package    op-asset-bootstrap2
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	namespace
 *
 */
namespace OP;

//	...
if( basename($_SERVER['SCRIPT_NAME']) === 'app.php' ){
	return;
}

//	...
switch( PHP_SAPI ){
	//	PHP Built-In Server
	case 'cli-server':
	return;
}

//	...
if( OP::isCI() ){
	return;
}

//	...
if(!file_exists( $path = __DIR__.'/../template/'.PHP_SAPI.'.phtml' ) ){
	$path = __DIR__.'/../template/404.phtml';
}

//	...
include(__DIR__.'/../template/html.phtml');

//	For Eclipse IDE never used notice.
echo $path;
