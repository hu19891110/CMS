<?php namespace DCN;

use Bican\Roles\Contracts\RoleContract;
use Bican\Roles\Traits\RoleTrait;
use Venturecraft\Revisionable\RevisionableTrait;

class Role extends \Bican\Roles\Models\Role  implements RoleContract{
    use RoleTrait;
	use RevisionableTrait;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

}
