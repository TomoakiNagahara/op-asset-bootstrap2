<?php
/**	op-asset-bootstrap2:/index.php
 *
 * @genesis    2016-11-26  skeleton:/app/init.php
 * @rebirth    2025-06-10  op-asset-bootstrap2:/index.php
 * @version    1.0
 * @package    op-asset-bootstrap2
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

//	...
try {
	/** Include Application environment config.
	 *
	 * @genesis   2016-11-22  Created `config.php` in app-skeleton.
	 * @rebirth   2025-06-10  Rebirth via op-asset-bootstrap2:/index.php.
	 */
	foreach([
		'core/Bootstrap.php',
		'config/op.php',
		'config/php.php',
		'bootstrap/include/root.php',
		'bootstrap/include/config.php',
		'bootstrap/include/rewrite.php',
		'bootstrap/include/session.php',
	] as $file){

		//	Generate full path.
		$file = dirname(__DIR__) . '/' . $file;

		//	Include file into closure.
		if(!file_exists($file) ){
			//	...
			if( defined('_ROOT_GIT_') ){
				//	...
				$file = str_replace(_ROOT_GIT_, 'git:/', $file);
			}
			//	...
			throw new \Exception("`{$file}` is not found.");
		}

		//	Include a file inside a closure.
		call_user_func(function($file){
			include($file);
		}, $file);
	}

	//	Unset the variable.
	unset($file);

} catch ( \Throwable $e ){
	echo 'Bootstrap: ' . $e->getMessage();
	exit(__LINE__);
}
