<?php

namespace sekjun9878\MakePlugin;

class MakePlugin
{
	const VERSION = "1.0.0";

	/* MakePlugin Options */
	const MAKEPLUGIN_REAL_OUTPUT_PATH = 0b001;
	const MAKEPLUGIN_COMPRESS = 0b010;

	/**
	 * Makes a .phar packaged PocketMine plugin from a source directory.
	 *
	 * @param $sourcePath
	 * @param $pharOutputLocation
	 * @param $options
	 * @return bool
	 * @throws \Exception
	 */
	public static function makePlugin($sourcePath, $pharOutputLocation, $options)
	{
		/* Removes Leading '/' */
		$sourcePath = rtrim(str_replace("\\", "/", realpath($sourcePath)), "/") . "/";

		$description = self::getPluginDescription($sourcePath . "/plugin.yml");

		if($options & self::MAKEPLUGIN_REAL_OUTPUT_PATH)
		{
			$pharPath = $pharOutputLocation;
		}
		else
		{
			$pharPath = $pharOutputLocation . DIRECTORY_SEPARATOR . $description->getName() . "_v" . $description->getVersion() . ".phar";
		}

		if(file_exists($pharPath))
		{
			throw new \Exception("Phar path already exists");
		}

		$phar = new \Phar($pharPath);
		$phar->setMetadata([
			"name" => $description->getName(),
			"version" => $description->getVersion(),
			"main" => $description->getMain(),
			"api" => $description->getCompatibleApis(),
			"depend" => $description->getDepend(),
			"description" => $description->getDescription(),
			"authors" => $description->getAuthors(),
			"website" => $description->getWebsite(),
			"creationDate" => time(),
		]);

		$phar->setStub('<?php echo "PocketMine-MP plugin ' . $description->getName() . ' v' . $description->getVersion() . '\nThis file has been generated using DevTools v' . self::getVersion() . ' at ' . date("r") . '\n----------------\n";if(extension_loaded("phar")){$phar = new \Phar(__FILE__);foreach($phar->getMetadata() as $key => $value){echo ucfirst($key).": ".(is_array($value) ? implode(", ", $value):$value)."\n";}} __HALT_COMPILER();');

		$phar->setSignatureAlgorithm(\Phar::SHA1);

		$phar->startBuffering();

		foreach(new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($sourcePath)) as $file)
		{
			$path = ltrim(str_replace(["\\", $sourcePath], ["/", ""], $file), "/");
			if($path{0} === "." or strpos($path, "/.") !== false)
			{
				continue;
			}
			$phar->addFile($file, $path);
		}

		if($options * self::MAKEPLUGIN_COMPRESS)
		{
			$phar->compressFiles(\Phar::GZ);
		}

		$phar->stopBuffering();

		return true;
	}

	/**
	 * Gets the PluginDescription from a plugin.yml
	 *
	 * @param string $file
	 * @return PluginDescription
	 * @throws \Exception
	 */
	public static function getPluginDescription($file)
	{
		$descriptionArray = yaml_parse_file($file);

		if($descriptionArray === false)
		{
			throw new \Exception("Could not read input plugin.yml file");
		}

		return new PluginDescription($descriptionArray);
	}

	public static function getVersion()
	{
		return self::VERSION;
	}
}