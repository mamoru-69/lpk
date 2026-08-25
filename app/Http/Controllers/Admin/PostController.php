<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller {
 public function index(){ return view('admin.posts.index',['items'=>Post::latest('published_at')->latest('id')->get()]); }
 public function create(){ return view('admin.posts.form',['post'=>new Post]); }
 public function store(Request $r){
  $data=$this->data($r);
  $data['slug']=$this->uniqueSlug($data['title']);
  if($r->hasFile('image')) $data['image']=$r->file('image')->store('posts','public');
  Post::create($data);
  return redirect()->route('admin.posts.index')->with('success','Berita ditambahkan.');
 }
 public function edit(Post $post){ return view('admin.posts.form',compact('post')); }
 public function update(Request $r,Post $post){
  $data=$this->data($r);
  if($post->title!==$data['title']) $data['slug']=$this->uniqueSlug($data['title'],$post->id);
  if($r->hasFile('image')){
   if($post->image) Storage::disk('public')->delete($post->image);
   $data['image']=$r->file('image')->store('posts','public');
  }
  $post->update($data);
  return redirect()->route('admin.posts.index')->with('success','Berita diperbarui.');
 }
 public function destroy(Post $post){
  if($post->image) Storage::disk('public')->delete($post->image);
  $post->delete();
  return back()->with('success','Berita dihapus.');
 }
 private function data(Request $r): array {
  return $r->validate([
   'title'=>'required|max:200',
   'excerpt'=>'nullable|max:300',
   'content'=>'required',
   'published_at'=>'nullable|date',
   'is_active'=>'nullable|boolean',
   'image'=>'nullable|image|max:5120',
  ]);
 }
 private function uniqueSlug(string $title,?int $ignoreId=null): string {
  $slug=Str::slug($title);
  $base=$slug;
  $i=1;
  while(Post::where('slug',$slug)->when($ignoreId,fn($q)=>$q->where('id','!=',$ignoreId))->exists()){
   $slug=$base.'-'.$i++;
  }
  return $slug;
 }
}
