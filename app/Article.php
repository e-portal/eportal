<?php

namespace Fresh\Estet;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'alias', 'content', 'category_id', 'created_at', 'approved', 'seo', 'own', 'view'];

    /**
     *  Get the category associated with the blog.
     */
    public function category()
    {
        return $this->belongsTo('Fresh\Estet\Category');
    }

    /**
     *  Get the main_img associated with the blog.
     */
    public function image()
    {
        return $this->hasOne('Fresh\Estet\Image');
    }

    /**
     *  Get the content_imgs associated with the blog.
     */
    public function photo()
    {
        return $this->hasMany('Fresh\Estet\Photo');
    }

    public function tags()
    {
        return $this->belongsToMany('Fresh\Estet\Tag', 'article_tag');
    }

    public function hasTag($id)
    {
        foreach ($this->tags as $tag) {
            if ($tag->id == $id) {
                return true;
            }
        }
        return false;
    }

    public function hasEstablishment($id)
    {
        foreach ($this->establishments as $establishment) {
            if ($establishment->id == $id) {
                return true;
            }
        }
        return false;
    }
    /**
     *  Get the role associated with the establishments.
     */

    public function establishments()
    {
        return $this->belongsToMany('Fresh\Estet\Establishment','mentions')->select(['id', 'title']);
    }

    public function comments()
    {
        return $this->hasMany('Fresh\Estet\Comment')->where('approved', 1);
    }
}
