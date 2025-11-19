<?php
/**	op-asset-bootstrap2:/include/appid.php
 *
 * @created    2025-07-20
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
if( $path = OP()->Config('app_id')[OP::_APP_ID_] ){
	return;
}

//	...
$path = __DIR__.'/../template/appid.phtml';

//	...
include(__DIR__.'/../template/html.phtml');

//	For Eclipse IDE never used notice.
echo $path;
