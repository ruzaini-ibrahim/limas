<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    
    protected $fillable = [
    	'type','belongs_to','file_name','file_path','file_url','file_size'
    ];
}
