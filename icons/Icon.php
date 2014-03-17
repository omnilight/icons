<?php

namespace yz\icons;

use yii\base\Object;
use yii\helpers\Html;


/**
 * Class Icon
 */
class Icon extends Object
{
    public $name;
    public $options = [];
    public $iconsSet = null;
    public $tag = null;
    public $append = '';
    public $prepend = '';

    /**
     * @return string
     */
    function __toString()
    {
        return $this->render();
    }

    /**
     * Renders icon
     * @return string
     */
    public function render()
    {
        return $this->prepend . Icons::i($this->name, $this->options, $this->iconsSet, $this->tag) . $this->append;
    }

    /**
     * Adds css class to the icon
     * @param string $class
     * @return $this
     */
    public function ac($class)
    {
        Html::addCssClass($this->options, $class);
        return $this;
    }

    /**
     * Removes css class from the icon
     * @param string $class
     * @return $this
     */
    public function rc($class)
    {
        Html::removeCssClass($this->options, $class);
        return $this;
    }

    /**
     * Appends icon with some text
     * @param $value
     * @return $this
     */
    public function app($value)
    {
        $this->append = $value;
        return $this;
    }

    /**
     * Prepends icon with some text
     * @param $value
     * @return $this
     */
    public function pre($value)
    {
        $this->prepend = $value;
        return $this;
    }
} 