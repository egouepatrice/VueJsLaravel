<?php

namespace App\Helpers\Api\V1;

//use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\DB;

trait TranslationHelper {

    public function translate($table_name,$colomn_name,$id,$language){
        $translation = DB::table('transmod_translation')
            ->select('translation_value')
            ->where('table_name','=',$table_name)
            ->where('colomn_name','=',$colomn_name)
            ->where('foreign_key','=',$id)
            ->where('locale','=',$language)
            ->first();
        if ($translation){
            return $translation->translation_value;
        }else{
            return "_ _";
        }
    }

}
