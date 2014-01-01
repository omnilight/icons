<?php

namespace yz\icons;

use yii\base\InvalidConfigException;
use yii\web\AssetBundle;
use yii\web\AssetManager;
use Yii;


/**
 * Class FontAwesomeAsset
 * @package omnilight\icons
 */
class FontAwesomeAsset extends AssetBundle
{
	public $sourcePath = '@vendor/fortawesome/font-awesome';
	public $css = array(
		'css/font-awesome.min.css',
	);

	public $copyFolders = ['fonts','css'];

	public function init()
	{
		$sourcePath = Yii::getAlias($this->sourcePath);
		$this->publishOptions['beforeCopy'] = function($from, $to) use ($sourcePath) {
			if (strncmp(basename($from), '.', 1) === 0)
				return false; // Do not copy hidden folders
			else {
				// Coping only css and fonts folders
				foreach ($this->copyFolders as $folder) {
					$folder = $sourcePath . '/' . $folder;
					if (strpos($from, $folder) === 0)
						return true;
				}
				return false;
			}
		};

		parent::init();
	}


}