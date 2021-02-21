<?php

namespace App\Http\Controllers\Recruitment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;


class DataTreeController extends Controller
{
	public function __construct(Cat $mcat)
	{
    $this->mcat = $mcat;
	}

  public function data_tree($data , $parent_id ,$level = 0) 
  {
    $result = [];
    foreach ($data as $key => $value) {
        if ($value['parent_id'] == $parent_id) {
            $value['level'] = $level;
            $result[] = $value;
            unset($data[$key]);
            $child  = $this->data_tree($data , $value['id_cat'], $level +1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
  }

  public function cat() 
  {
    $cats = $this->mcat->getCats();
    $new = [];
    foreach ($cats as  $cat) {
      $id_cat    = $cat->id_cat;
      $cname     = $cat->cname;
      $parent_id = $cat->parent_id;
       
      $arNew = array(
          'id_cat'    => $id_cat,
          'cname'     => $cname,
          'parent_id' => $parent_id,
          );
      $new[$id_cat] =  $arNew;
    }
    $arResult = [];
    foreach ($cats as  $cat) {
      $id_cat    = $cat->id_cat;
      $cname     = $cat->cname;
      $parent_id = $cat->parent_id;
      if ($parent_id == 0 ) {
        $arCats = $this->data_tree($new, $id_cat, 1);
        $arResult[$cname.'-'.$id_cat] = $arCats;
      }
    }
    return $arResult;
  }
}
