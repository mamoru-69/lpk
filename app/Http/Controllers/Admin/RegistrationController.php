<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
class RegistrationController extends Controller {
 public function index(Request $r){
  $query=Registration::with('program')->latest();
  if($r->filled('status') && array_key_exists($r->status, Registration::STATUSES)){
   $query->where('status',$r->status);
  }
  return view('admin.registrations.index',[
   'items'=>$query->paginate(20)->withQueryString(),
   'statuses'=>Registration::STATUSES,
   'currentStatus'=>$r->status,
   'counts'=>Registration::query()->selectRaw('status, count(*) as total')->groupBy('status')->pluck('total','status'),
  ]);
 }
 public function show(Registration $registration){
  $registration->load('program');
  return view('admin.registrations.show',compact('registration'));
 }
 public function update(Request $r, Registration $registration){ $registration->update($r->validate(['status'=>'required|in:baru,dihubungi,seleksi,lulus,ditolak,berangkat','notes'=>'nullable|string'])); return back()->with('success','Status diperbarui.'); }
 public function destroy(Registration $registration){
  foreach(['photo','ktp','ijazah'] as $file){
   if($registration->{$file}) \Illuminate\Support\Facades\Storage::disk('public')->delete($registration->{$file});
  }
  $registration->delete();
  return redirect()->route('admin.registrations.index')->with('success','Data dihapus.');
 }
}
