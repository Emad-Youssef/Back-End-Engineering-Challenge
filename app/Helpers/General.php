<?php

use App\Models\Option;
use App\Models\Property;


// dir style
if(!function_exists('getFolder')){
  function getFolder()
  {
      return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
  }
}

if(!function_exists('get_permission')){
  function get_permission($per){
      return auth('admin')->user()->hasPermission($per);
  }
}

// upload file
if(!function_exists('uploadImage')){
  function uploadImage($folder,$file){
      $file->store('/',$folder);
      $filename = $file->hashName();

      return $filename;
  }
}

// delete file
if(!function_exists('deleteImage')){
  function deleteImage($path,$file){
      if(\File::exists(public_path($path.$file)))
          return \File::delete(public_path($path.$file));
  }

}



