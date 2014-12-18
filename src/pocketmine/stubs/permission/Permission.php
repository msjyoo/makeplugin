<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

/**
 * Permission related classes
 */
namespace pocketmine\permission;

/**
 * Represents a permission
 */
class Permission{
	const DEFAULT_OP = "op";
	const DEFAULT_NOT_OP = "notop";
	const DEFAULT_TRUE = "true";
	const DEFAULT_FALSE = "false";

	public static $DEFAULT_PERMISSION = self::DEFAULT_OP;

	/**
	 * @param $value
	 *
	 * @return string
	 */
	public static function getByName($value) {}

	/** @var string */
	private $name;

	/** @var string */
	private $description;

	/**
	 * @var string[]
	 */
	private $children = [];

	/** @var string */
	private $defaultValue;

	/**
	 * Creates a new Permission object to be attached to Permissible objects
	 *
	 * @param string       $name
	 * @param string       $description
	 * @param string       $defaultValue
	 * @param Permission[] $children
	 */
	public function __construct($name, $description = null, $defaultValue = null, array $children = []) {}

	/**
	 * @return string
	 */
	public function getName() {}

	/**
	 * @return string[]
	 */
	public function &getChildren() {}

	/**
	 * @return string
	 */
	public function getDefault() {}

	/**
	 * @param string $value
	 */
	public function setDefault($value) {}

	/**
	 * @return string
	 */
	public function getDescription() {}

	/**
	 * @param string $value
	 */
	public function setDescription($value) {}

	/**
	 * @return Permissible[]
	 */
	public function getPermissibles(){}

	public function recalculatePermissibles() {}


	/**
	 * @param string|Permission $name
	 * @param                   $value
	 *
	 * @return Permission|void
	 */
	public function addParent($name, $value) {}

	/**
	 * @param array $data
	 * @param       $default
	 *
	 * @return Permission[]
	 */
	public static function loadPermissions(array $data, $default = self::DEFAULT_OP) {}

	/**
	 * @param string $name
	 * @param array  $data
	 * @param string $default
	 * @param array  $output
	 *
	 * @return Permission
	 *
	 * @throws \Exception
	 */
	public static function loadPermission($name, array $data, $default = self::DEFAULT_OP, &$output = []) {}
}