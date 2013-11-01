<?php

class Cat extends Eloquent {

   protected $table = 'cats';
   protected $softDelete = true; // deletes are still stored in DB

   public function oils() {
      return $this->hasMany('Oil', 'cat_id');
   }

   public static $rules = array(
      "name" => "required|min:2",
      "info" => "required|min:4",
   );


   public static function validate($data) {
      return Validator::make($data, static::$rules);
   }
} 

?>