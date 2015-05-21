<?php namespace DCN;

use Bican\Roles\Contracts\RoleContract;
use Bican\Roles\Traits\RoleTrait;
use Venturecraft\Revisionable\RevisionableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Role extends \Bican\Roles\Models\Role  implements RoleContract{
    use RoleTrait,RevisionableTrait, SearchableTrait;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function bySlug($roleSlug)
    {
        return self::where('slug',$roleSlug)->first();
    }

}
