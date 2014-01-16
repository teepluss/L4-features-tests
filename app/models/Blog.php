<?php

class Blog extends Eloquent {

    /**
     * Blog has many files upload.
     *
     * @return AttachmentRelate
     */
    public function files()
    {
        return $this->morphMany('\Teepluss\Up\AttachmentRelates\Eloquent\AttachmentRelate', 'fileable');
    }

    public function comments()
    {
        return $this->hasMany('Comment');
    }

}