<?php
/**
 * Created by PhpStorm.
 * User: kushagra
 * Date: 26/10/17
 * Time: 9:37 PM
 */

namespace App;


class WitEntity
{
    protected $type;
    protected $value;
    protected $confidence;

    public function __construct($type, $value, $confidence)
    {
        $this->type = $type;
        $this->value = $value;
        $this->confidence = $confidence;
    }
}