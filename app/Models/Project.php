<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
      'title',
      'type_id',
      'slug',
      'date',
      'image_name',
      'image_path',
      'description'
    ];

    public function type() {
      return $this->belongsTo(Type::class);
    }

    public function technologies() {
      return $this->belongsToMany(Technology::class);
    }

}
