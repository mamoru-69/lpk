<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ProgramController extends Controller {
    public function index(){ return view('admin.programs.index',['programs'=>Program::orderBy('sort_order')->get()]); }
    public function create(){ return view('admin.programs.form',['program'=>new Program]); }
    public function store(Request $r){ $data=$this->data($r); $data['slug']=Str::slug($data['name']); Program::create($data); return redirect()->route('admin.programs.index')->with('success','Program ditambahkan.'); }
    public function edit(Program $program){ return view('admin.programs.form',compact('program')); }
    public function update(Request $r, Program $program){ $data=$this->data($r); $data['slug']=Str::slug($data['name']); $program->update($data); return redirect()->route('admin.programs.index')->with('success','Program diperbarui.'); }
    public function destroy(Program $program){ $program->delete(); return back()->with('success','Program dihapus.'); }
    private function data(Request $r){ return $r->validate(['name'=>'required|max:150','category'=>'required|max:80','short_description'=>'nullable|max:300','description'=>'nullable','requirements'=>'nullable','duration'=>'nullable|max:100','sort_order'=>'nullable|integer','is_featured'=>'nullable|boolean','is_active'=>'nullable|boolean']); }
}
