<?php

namespace DCN;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status'];

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
    protected $dontKeepRevisionOf = ['user_id', 'sent_ts', 'received_ts'];

    public function user()
    {
        return $this->belongsTo('\Dcn\User');
    }
}
