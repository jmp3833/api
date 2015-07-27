<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Member;

class Tip extends Model
{
    use SoftDeletes;

    protected $appends = [
        'member_url',
        'updated_by_url',
        'url',
    ];

    protected $hidden = [
        'created_at',
        'created_by',
        'deleted_at',
        'member',
        'updated_at',
        'updated_by',
    ];

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'content',
    ];

    public function member()
    {
        return $this->belongsTo('App\Member', 'created_by');
    }

    public function updated_by()
    {
        return $this->belongsTo('App\Member');
    }

    public function getMemberUrlAttribute()
    {
        return $this->member->url;
    }

    public function getUpdatedByUrlAttribute()
    {
        return $this->updated_by ? $this->updated_by->url : '';
    }

    public function getUrlAttribute()
    {
        return route('api.v1.tips.show', ['id' => $this->id]);
    }
}
