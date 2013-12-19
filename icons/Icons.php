<?php

namespace omnilight\icons;


use yii\base\InvalidCallException;
use yii\helpers\Html;
use yii\web\AssetBundle;
use yii\web\View;

/**
 * Class Icons
 * @package omnilight\icons
 */
class Icons
{
	const SET_FONTAWESOME = 'font-awesome';

	/**
	 * @var string Name of the default set of icons
	 */
	public static $iconsSet = self::SET_FONTAWESOME;

	public static $config = [
		self::SET_FONTAWESOME => ['prefix' => 'fa-', 'tag' => 'i', 'asset' => '\\omnilight\\icons\\FontAwesomeAsset'],
	];

	private static $_isAssetRegistered = [];

	/**
	 * @param string $name the name of the icon
	 * @param array $options the icon options
	 * @param string $iconSet the name of the icon set
	 * @param string $tag the html tag used to create icon
	 * @throws \yii\base\InvalidCallException
	 * @return string
	 */
	public static function i($name, $options = [], $iconSet = null, $tag = null)
	{
		$iconSet = $iconSet? : static::$iconsSet;
		if (!isset(self::$_isAssetRegistered[$iconSet]) )
			throw new InvalidCallException('Icon set'.$iconSet.' must be registered before using Icons::i function');
		$tag = $tag? : static::$config[$iconSet]['tag'];
		$options['class'] = static::$config[$iconSet]['iconSet'].$name;
		return Html::tag($tag, '', $options);
	}

	/**
	 * @param View $view
	 * @param string|null $iconSet
	 */
	public static function register($view, $iconSet = null)
	{
		if ($iconSet === null) {
			foreach(static::$config as $iconSet) {
				static::register($view, $iconSet);
			}
		} else {
			if (isset(self::$_isAssetRegistered[$iconSet]) )
				return;
			/** @var AssetBundle $class */
			$class = static::$config[$iconSet]['asset'];
			$class::register($view);
			self::$_isAssetRegistered[$iconSet] = true;
		}
	}
}