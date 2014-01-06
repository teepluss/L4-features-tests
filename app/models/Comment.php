<?php

class Comment extends Eloquent {

    public function blog()
    {
        return $this->belongsTo('Blog');
    }

    public function authors()
    {
        return $this->hasMany('Author');
    }

    public function scopeRecent($query)
    {
        return $query->whereNotNull('created_at');
    }

}