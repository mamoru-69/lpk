<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
class FaqController extends Controller {
 public function index(){ return view('admin.faqs.index',['items'=>Faq::orderBy('sort_order')->get()]); }
 public function create(){ return view('admin.faqs.form',['faq'=>new Faq]); }
 public function store(Request $r){ Faq::create($this->data($r)); return redirect()->route('admin.faqs.index')->with('success','FAQ ditambahkan.'); }
 public function edit(Faq $faq){ return view('admin.faqs.form',compact('faq')); }
 public function update(Request $r,Faq $faq){ $faq->update($this->data($r)); return redirect()->route('admin.faqs.index')->with('success','FAQ diperbarui.'); }
 public function destroy(Faq $faq){ $faq->delete(); return back()->with('success','FAQ dihapus.'); }
 private function data(Request $r){ return $r->validate(['question'=>'required|max:255','answer'=>'required','sort_order'=>'nullable|integer','is_active'=>'nullable|boolean']); }
}
