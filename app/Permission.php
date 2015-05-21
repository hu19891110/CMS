<?php namespace DCN;

use Illuminate\Database\Eloquent\Model;
use Bican\Roles\Traits\PermissionTrait;
use Bican\Roles\Contracts\PermissionContract;
use Venturecraft\Revisionable\RevisionableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class Permission extends \Bican\Roles\Models\Permission implements PermissionContract
{

    use PermissionTrait, RevisionableTrait, SearchableTrait;

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

}
