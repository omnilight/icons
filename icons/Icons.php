<?php

namespace yz\icons;


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
		self::SET_FONTAWESOME => ['prefix' => 'fa fa-', 'tag' => 'i', 'asset' => '\\yz\\icons\\FontAwesomeAsset'],
	];

	private static $_isAssetRegistered = [];

	/**
	 * Outputs icon tag with specified name
	 * @param string $name the name of the icon
	 * @param array $options the icon options
	 * @param string $iconsSet the name of the icon set
	 * @param string $tag the html tag used to create icon
	 * @throws \yii\base\InvalidCallException
	 * @return string
	 */
	public static function i($name, $options = [], $iconsSet = null, $tag = null)
	{
		$iconsSet = $iconsSet? : static::$iconsSet;
		$tag = $tag? : static::$config[$iconsSet]['tag'];
		$options['class'] = static::$config[$iconsSet]['prefix'].$name;
		return Html::tag($tag, '', $options);
	}

	/**
	 * The same as {@see i} but output icons as a prefix for the text, followed by space symbol
	 * @param string $name the name of the icon
	 * @param array $options the icon options
	 * @param string $iconsSet the name of the icon set
	 * @param string $tag the html tag used to create icon
	 * @throws \yii\base\InvalidCallException
	 * @return string
	 */
	public static function p($name, $options = [], $iconsSet = null, $tag = null)
	{
		return static::i($name, $options, $iconsSet, $tag) . ' ';
	}

	/**
	 * @param View $view
	 * @param string|null $iconSet
	 */
	public static function register($view, $iconSet = null)
	{
		if ($iconSet === null) {
			foreach(static::$config as $iconSet => $values) {
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