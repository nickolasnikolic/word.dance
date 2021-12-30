<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Poem extends Model
{
    use Searchable;

    protected $table = 'poetry';

    protected $hidden = [

    ];

    //tagging implementation from rtconner
    use \Conner\Tagging\Taggable;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
