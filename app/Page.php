<?php namespace DCN;

use Auth;
use Baum\Node;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Page extends Node implements SluggableInterface
{

	use RevisionableTrait, SoftDeletes, SluggableTrait, SearchableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'content', 'owner_id', 'creator_id', 'updater_id', 'system', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['parent_id','lft','rgt','depth'];

    /**
     * The attributes excluded from revision
     *
     * @var array
     */
    protected $dontKeepRevisionOf = ['updater_id','parent_id','lft','rgt','depth'];

    public function Owner()
    {
        return $this->belongsTo('\Dcn\User');
    }

    public function getOwnerNameAttribute()
    {
        return $this->owner->username;
    }

    public function Creator()
    {
        return $this->belongsTo('\Dcn\User');
    }

    public function getCreatorNameAttribute()
    {
        return $this->creator->username;
    }

    public function Updater()
    {
        return $this->belongsTo('\Dcn\User');
    }

    public function getUpdaterNameAttribute()
    {
        return $this->updater->username;
    }

    public function getURLAttribute()
    {
        $ancestors = $this->ancestorsAndSelf()->get();
        $sections=array();
        foreach($ancestors as $ancestor)
        {
            $sections[]=$ancestor->slug;
        }
        return implode("/",$sections);
    }
    public function save(array $options = array())
    {
        $user = Auth::user();
        $this->Updater()->associate($user);
        parent::save($options);
    }
}
