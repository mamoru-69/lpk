<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller {
 public function index(){ return view('admin.galleries.index',['items'=>Gallery::orderBy('sort_order')->get()]); }
 public function create(){ return view('admin.galleries.form',['gallery'=>new Gallery]); }
 public function store(Request $r){
  $data=$this->data($r,true);
  $data['image']=$r->file('image')->store('galleries','public');
  Gallery::create($data);
  return redirect()->route('admin.galleries.index')->with('success','Galeri ditambahkan.');
 }
 public function edit(Gallery $gallery){ return view('admin.galleries.form',compact('gallery')); }
 public function update(Request $r,Gallery $gallery){
  $data=$this->data($r,$r->hasFile('image'));
  if($r->hasFile('image')){
   if($gallery->image) Storage::disk('public')->delete($gallery->image);
   $data['image']=$r->file('image')->store('galleries','public');
  }
  $gallery->update($data);
  return redirect()->route('admin.galleries.index')->with('success','Galeri diperbarui.');
 }
 public function destroy(Gallery $gallery){
  if($gallery->image) Storage::disk('public')->delete($gallery->image);
  $gallery->delete();
  return back()->with('success','Galeri dihapus.');
 }
 private function data(Request $r,bool $requireImage): array {
  return $r->validate([
   'title'=>'required|max:150',
   'category'=>'nullable|max:80',
   'sort_order'=>'nullable|integer',
   'is_active'=>'nullable|boolean',
   'image'=>$requireImage?'required|image|max:5120':'nullable|image|max:5120',
  ]);
 }
}
