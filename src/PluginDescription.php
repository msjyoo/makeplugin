<?php
/**
 * Created by PhpStorm.
 * User: Michael
 * Date: 18/12/2014
 * Time: 12:15 PM
 */

namespace CakePowered\PluginLib;

class PluginDescription extends \pocketmine\plugin\PluginDescription
{
	/**
	 * PluginDescription modified to accept arrays
	 *
	 * @param array $pluginDescription
	 */
	public function __construct(array $pluginDescription)
	{
		$this->loadMap($pluginDescription);
	}
}