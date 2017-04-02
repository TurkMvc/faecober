<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Haber extends Model
{
    use SoftDeletes;

    protected $table='haberler';

    protected $fillable=['baslik','icerik','kullanici_id','slug'];

    protected $dates=['deleted_at'];

}
