<?php
/**	op-asset-bootstrap2:/include/admin.php
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
if( OP::isCI() ){
//	return;
}

//	...
$admin = Config::Get('admin');

//	...
if( isset($admin[OP::_ADMIN_IP_]) ){
	return;
}

//	...
$path = __DIR__.'/../template/admin.phtml';

//	...
include(__DIR__.'/../template/html.phtml');

//	For Eclipse IDE never used notice.
echo $path;
