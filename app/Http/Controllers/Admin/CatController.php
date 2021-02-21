<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Recruitment\DataTreeController;
use Illuminate\Http\Request;
use App\Http\Requests\CatRequest;
use App\Models\Cat;

class CatController extends Controller
{	
	public function __construct(Cat $mcat, DataTreeController $cdata_tree)
  {
    $this->mcat       = $mcat;
    $this->cdata_tree = $cdata_tree;
  }

  public function index()
  {
    $arResult = $this->cdata_tree->cat();
  	return view('admin.cat.index', ['arResults' => $arResult]);
  }
    
  public function add(Request $request)
  {
    $id = $request->id;
    return view('admin.cat.add',compact('id'));
  }

  public function postAdd(CatRequest $request)
  {
    $cname     = $request->cname;
    $id        = $request->id;
    $parent_id = 0;
    $cats      = $this->mcat->getCats($id);
    $dem       = 0;

    foreach ($cats as $cat){
       if ($cat->cname == $cname) {
          $dem++;
       }
    }
    if ($dem > 0) {
       return redirect()->route('admin.cat.add')->with('msg', 'Category already exists.');
    }
    if ($id != null) {
       $parent_id = $id;
    }
    $data = [
       'cname'     => $cname,
       'parent_id' => $parent_id
    ];
    $result = $this->mcat->addCat($data);
    if ($result) {
       return redirect()->route('admin.cat.index')->with('msg', 'More success.');
    }else{
       return redirect()->route('admin.cat.index')->with('msg', 'Error. Please try again.');
    }  
  }

  public function edit($id)
  {   
    $cat = $this->mcat->getCat($id);
    return view('admin.cat.edit', compact('cat'));
  }

  public function postEdit(CatRequest $request, $id)
  {
    $cname = $request->cname;
    $cats  = $this->mcat->getCats($id);
    $dem   = 0;

    foreach ($cats as $cat){
       if ($cat->cname == $cname) {
          $dem++;
       }
    }
    if ($dem > 0) {
       return redirect()->route('admin.cat.edit',$id)->with('msg', 'Category already exists.');
    }
    $data = [
        'cname' => $cname
    ];
    $result = $this->mcat->editCat($data, $id);
    if ($result) {
      return redirect()->route('admin.cat.index')->with('msg', 'Corrected successfully.');
    }else{
      return redirect()->route('admin.cat.index')->with('msg', 'Error. Please try again.');
    }  
  }
   
  public function del($id)
  {
    $cat = $this->mcat->getCat($id);
    if ($cat->parent_id != 0) {
      $result = $this->mcat->delCat($id);
      return redirect()->route('admin.cat.index')->with('msg', 'Deleted successfully.');
    }else{
      $result = $this->mcat->delCatLQ($id);
      return redirect()->route('admin.cat.index')->with('msg', 'Deleted successfully.');
    }  
  }
}
