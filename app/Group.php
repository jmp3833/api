<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $appends = ['head_url', 'url'];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'head',
        'members',
        'updated_at',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name',
    ];

    public function head()
    {
        return $this->belongsTo('App\Officer');
    }

    public function members()
    {
        return $this->belongsToMany('App\Member')->withTimestamps();
    }

    public function getHeadUrlAttribute()
    {
        return $this->head->url;
    }

    public function getUrlAttribute()
    {
        return route('api.v1.groups.show', ['id' => $this->id]);
    }
}
