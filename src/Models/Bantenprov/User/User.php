<?php

namespace Bantenprov\User\Models\Bantenprov\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $table = 'users';
    protected $dates = [
        'deleted_at'
    ];
    protected $fillable = [
        'label',
        'description'
    ];
}
