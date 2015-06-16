<?php namespace DCN;

use Bican\Roles\Traits\RoleHasRelations;
use Bican\Roles\Contracts\RoleHasRelations as RoleHasRelationsContract;
use Venturecraft\Revisionable\RevisionableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Role extends \Bican\Roles\Models\Role  implements RoleHasRelationsContract{
    use RoleHasRelations,RevisionableTrait, SearchableTrait;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public static function bySlug($roleSlug)
    {
        return self::where('slug',$roleSlug)->first();
    }

}
