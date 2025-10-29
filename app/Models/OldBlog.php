<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldBlog extends Model
{
    protected $connection = 'production';
    protected $table = 'blog';
    
    protected $fillable = [
        'header', 'content', 'image', 'tags', 'meta_title', 
        'meta_description', 'status', 'type'
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function getTagsArrayAttribute()
    {
        return is_string($this->tags) ? explode(' ', $this->tags) : $this->tags;
    }

    public function getExcerptAttribute()
    {
        return strip_tags(mb_strimwidth($this->content, 0, 200, "..."));
    }
}
