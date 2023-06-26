<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class CustomHelper {

  public static function generateSlug($model, $str){
    $slug = Str::slug($str, '-');
    $original_slug = $slug;
    $slug_exixts = $model::where('slug', $slug)->first();
    $c = 1;
   while($slug_exixts){
        $slug = $original_slug . '-' . $c;
        $slug_exixts = $model::where('slug', $slug)->first();
        $c++;
    }
    return $slug;
  }

}
