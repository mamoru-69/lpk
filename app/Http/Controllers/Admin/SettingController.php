<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller {
 public function edit(){ return view('admin.settings.edit',['settings'=>Setting::pluck('value','key')]); }
 public function update(Request $r){
  $translatableKeys=[
   'tagline','hero_title','hero_subtitle',
   'profile_title','profile_subtitle','profile_about_title','profile_about_body','profile_vision',
   'profile_mission','profile_identity_name','profile_identity_status','profile_identity_focus','profile_identity_area',
   'legal_title','legal_subtitle','legal_nib_title','legal_nib_body','legal_license_title',
   'legal_license_body','legal_partner_title','legal_partner_body',
  ];
  $textKeys=[
   'site_name','tagline','phone','whatsapp','email','address','map_embed','hero_title','hero_subtitle',
   'profile_title','profile_subtitle','profile_about_title','profile_about_body','profile_vision',
   'profile_mission','profile_identity_name','profile_identity_status','profile_identity_focus','profile_identity_area',
   'legal_title','legal_subtitle','legal_nib_title','legal_nib_body','legal_license_title',
   'legal_license_body','legal_partner_title','legal_partner_body',
  ];
  foreach($translatableKeys as $key){
   foreach(['en','ja'] as $locale){
    $textKeys[]="{$key}_{$locale}";
   }
  }
  foreach($textKeys as $key){
   if($r->has($key)) Setting::updateOrCreate(['key'=>$key],['value'=>$r->input($key)]);
  }
  if($r->boolean('remove_hero_background')){
   $this->deleteHeroBackground();
  }elseif($r->hasFile('hero_background')){
   $r->validate(['hero_background'=>'required|image|max:5120']);
   $this->deleteHeroBackground();
   $path=$r->file('hero_background')->store('settings','public');
   Setting::updateOrCreate(['key'=>'hero_background'],['value'=>$path]);
  }
  return back()->with('success','Pengaturan disimpan.');
 }
 private function deleteHeroBackground(): void {
  $old=Setting::getValue('hero_background');
  if($old) Storage::disk('public')->delete($old);
  Setting::where('key','hero_background')->delete();
 }
}
