<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forwarder extends Model
{
    use HasFactory;

    public $timestamps = false;


    protected $table = 'calchip_forwarder';

    protected $fillable = ['first_name', 'last_name'];
}
