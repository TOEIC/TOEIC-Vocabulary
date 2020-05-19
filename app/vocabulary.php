<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vocabulary extends Model
{
    //
    // protected $primaryKey = “id”; //指定主鍵
    protected $table = "vocabulary"; //指定資料表名稱
    // public $timestamps = false; //若要取消時間戳記
    protected $fillable = [ //新增的欄位名稱
        'num',
        'level',
        'en',
        'pos',
        'zh',
    ];

    /*public function user()
    {
        return $this->belongsTo(User::class);
    }*/


}
