<?php

use App\Models\Admin;





// get parent category for subcategories in datatables
if(!function_exists('getRole')){
    function getRole($id){
      $role = Admin::with('roles:id,name')->find($id);
      return $role->roles[0]->name;
    }
}

