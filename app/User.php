<?php namespace DCN;

use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Contracts\HasRoleAndPermissionContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasRoleAndPermissionContract {

	use Authenticatable, CanResetPassword, HasRoleAndPermission, RevisionableTrait, SoftDeletes, SearchableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name_first', 'name_middle', 'name_last', 'username', 'email', 'password','status','status_ts'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'otc', 'otc_ts'];

    /**
     * The attributes excluded from revision
     *
     * @var array
     */
    protected $dontKeepRevisionOf = ['remember_token', 'otc', 'otc_ts'];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'name_first' => 2,
            'name_middle' => 2,
            'name_last' => 2,
            'username' => 5,
            'email' => 2,
        ]
    ];

    /**
     * Generate the hash for the new password
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password))
        {
            $password = Hash::make($password);
            $this->attributes['password'] = $password;
        }
    }

    /**
     * Set the middle name to NULL if nothing is passed to it.
     *
     * @param $middle
     */
    public function setNameMiddleAttribute($middle)
    {
        $this->attributes['name_middle'] = $middle ? $middle : null;
    }

    public function getNameFullAttribute()
    {
        return $this->attributes['name_first']." ".$this->attributes['name_middle']." ".$this->attributes['name_last'];
    }

    /**
     * Create a One Time Code and set the TS for the code
     * @param bool $save
     */
    public function createOTC($save=true)
    {
        $this->otc=str_random(40);
        $this->otc_ts = Carbon::now();
        if($save)
        {
            $this->save();
        }
    }

    /**
     * Check if the inputted code is the code we have on record.
     * @param $otc
     * @param bool $reset
     * @return bool
     */
    public function checkOTC($otc, $reset=true)
    {
        if($this->otc === $otc)
        {
            if($reset)
            {
                $this->otc=null;
                $this->otc_tc = null;
                $this->save();
            }
            return true;
        }
        return false;
    }

}
