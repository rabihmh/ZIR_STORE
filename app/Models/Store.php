<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $connection = 'mysql';//it used if I have multiple connection database
    protected $table = 'stores';
    protected $primaryKey = 'id';
    protected $keyType = 'int'; //The "type" of the primary key ID.
    public $incrementing = true;//true by default, (Indicates if the IDs are auto-incrementing)
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');

    }
}
