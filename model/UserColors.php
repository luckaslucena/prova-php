<?php

class UserColors
{
    private $color_id;
    private $user_id;

    public function __construct($color_id = null, $user_id = null)
    {
        $this->color_id = $color_id;
        $this->user_id = $user_id;
    }

    public function getColorId()
    {
        return $this->color_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setColorId($color_id)
    {
        $this->color_id = $color_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}
