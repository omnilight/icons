<?php

namespace yz\icons;

use Yii;
use yii\web\AssetBundle;


/**
 * Class FontAwesomeAsset
 * @package omnilight\icons
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@bower/fortawesome/font-awesome';
    public $css = array(
        'css/font-awesome.min.css',
    );
}