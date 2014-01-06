<?php

class Blog extends Eloquent {

    public function comments()
    {
        return $this->hasMany('Comment');
    }

}