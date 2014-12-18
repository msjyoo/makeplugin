<?php

namespace sekjun9878\MakePlugin;

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