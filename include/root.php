<?php
/**	op-asset-bootstrap2:/include/root.php
 *
 * @created    2022-10-30  op-skeleton-2020:/asset/rootpath.php
 * @rebirth    2025-06-11  op-asset-bootstrap2:/include/root.php
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
require_once(_ROOT_CORE_.'/function/RootPath.php');

//	...
RootPath('git'  , _ROOT_GIT_  );
RootPath('app'  , _ROOT_APP_  );
RootPath('core' , _ROOT_CORE_ );
RootPath('asset', _ROOT_ASSET_);
