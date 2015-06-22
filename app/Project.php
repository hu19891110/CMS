<?php

namespace DCN;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Project extends Model implements SluggableInterface
{
    use RevisionableTrait, SluggableTrait, SearchableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'content', 'owner_id', 'status', 'goal', 'progress'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes excluded from revision
     *
     * @var array
     */
    protected $dontKeepRevisionOf = ['progress'];

    public function Owner()
    {
        return $this->belongsTo('\Dcn\User');
    }

    public function getOwnerNameAttribute()
    {
        return $this->owner->username;
    }
}
