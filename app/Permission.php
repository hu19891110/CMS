<?php namespace DCN;

use Illuminate\Database\Eloquent\Model;
use Bican\Roles\Traits\PermissionHasRelations;
use Bican\Roles\Contracts\PermissionHasRelations as PermissionHasRelationsContract;
use Venturecraft\Revisionable\RevisionableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Permission extends \Bican\Roles\Models\Permission implements PermissionHasRelationsContract
{

    use PermissionHasRelations, RevisionableTrait, SearchableTrait;

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name' => 2,
            'slug' => 5,
            'description' => 2,
        ]
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function bySlug($slug)
    {
        return self::where('slug',$slug)->first();
    }
}
