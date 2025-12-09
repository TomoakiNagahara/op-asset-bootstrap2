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
	$config = OP()->Config('admin');
	if( empty($config[OP::_ADMIN_IP_])   ){ $config[OP::_ADMIN_IP_]   = '127.0.0.1'; }
	if( empty($config[OP::_ADMIN_MAIL_]) ){ $config[OP::_ADMIN_MAIL_] = 'root@localhost'; }
	if( empty($config[OP::_ADMIN_FROM_]) ){ $config[OP::_ADMIN_FROM_] = 'root@localhost'; }
	OP()->Config('admin', $config);
	return;
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
