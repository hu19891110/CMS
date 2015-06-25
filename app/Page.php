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
        'save_to' => 'slug',
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
    protected $hidden = ['parent_id', 'lft', 'rgt', 'depth'];

    /**
     * The attributes excluded from revision
     *
     * @var array
     */
    protected $dontKeepRevisionOf = ['updater_id', 'parent_id', 'lft', 'rgt', 'depth'];

    public function owner()
    {
        return $this->belongsTo('\Dcn\User');
    }

    public function getOwnerNameAttribute()
    {
        return $this->owner->username;
    }

    public function creator()
    {
        return $this->belongsTo('\Dcn\User');
    }

    public function getCreatorNameAttribute()
    {
        return $this->creator->username;
    }

    public function updater()
    {
        return $this->belongsTo('\Dcn\User');
    }

    public function getUpdaterNameAttribute()
    {
        return $this->updater->username;
    }

    //Create the HTML For Re Ordering Pages
    public static function order($currentPage = null)
    {
        //First Lets Get All Of The Root Pages
        $roots = Page::roots()->get();
        return self::orderWork($roots, $currentPage);
    }

    public function move($parent_id=null, $lft=null, $rgt=null, $depth=null)
    {
        if($this->parent_id != $parent_id)
            $this->parent_id = $parent_id;
        if($this->lft != $lft)
            $this->lft = $lft;
        if($this->rgt != $rgt)
            $this->rgt = $rgt;
        if($this->depth !=$depth)
            $this->depth = $depth;

        $this->save();
    }

    //The Function that does all the work to create the Re Ordering Of Pages
    private static function orderWork($pages,$currentPage)
    {

        //Lets Create a Holder For Our HTML
        $html = '';

        //Next Lets Go Through Them All
        foreach($pages as $page)
        {
            //Check if the page has children
            if(!is_null($page->children()->first()))
            {
                //The Page Does Have Children
                if($currentPage==$page->id)
                    $html.="<li id=\"menuItem_".$page->id."\"><div><b>".$page->title."</b></div><ol>";
                else
                    $html.="<li id=\"menuItem_".$page->id."\"><div>".$page->title."</div><ol>";

                //OutPut Children
                $html.=self::orderWork($page->children()->get(),$currentPage);

                //End The Link
                $html.="</ol></li>";
            }else{
                //The Page Doesn't Have Children
                //Output Link
                if($currentPage==$page->id)
                    $html.="<li id=\"menuItem_".$page->id."\"><div><b>".$page->title."</b></div></li>";
                else
                    $html.="<li id=\"menuItem_".$page->id."\"><div>".$page->title."</div></li>";
            }
        }
        return $html;
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

    /**
     * @param array $attributes
     * @return static
     */
    public static function create(array $attributes = array())
    {
        $attributes = array_merge($attributes, ['creator_id'=>Auth::user()->id]);
        return parent::create($attributes);
    }
}
