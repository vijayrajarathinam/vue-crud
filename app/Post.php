<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\DataTable;

class Post extends Model
{
    use DataTable;
    protected $fillable =[
        'title','description'
    ];
    
    public static $column = [
        'id','title','description','created_at'
    ];
}
