<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Program; use App\Models\Faq; use App\Models\Setting;
class ComproSeeder extends Seeder { public function run():void{
 $programs=[
 ['name'=>'Bahasa Jepang Dasar N5','slug'=>'bahasa-jepang-dasar-n5','category'=>'Bahasa Jepang','short_description'=>'Fondasi hiragana, katakana, tata bahasa dasar dan komunikasi sehari-hari.','duration'=>'3-4 bulan','is_featured'=>1,'sort_order'=>1],
 ['name'=>'Persiapan JLPT N4 / JFT-Basic','slug'=>'persiapan-jlpt-n4-jft-basic','category'=>'Persiapan Ujian','short_description'=>'Program intensif untuk peningkatan kemampuan bahasa Jepang dan persiapan ujian.','duration'=>'2-4 bulan','is_featured'=>1,'sort_order'=>2],
 ['name'=>'Persiapan Tokutei Ginou','slug'=>'persiapan-tokutei-ginou','category'=>'Kerja Jepang','short_description'=>'Pembekalan bahasa, budaya kerja, wawancara dan kesiapan seleksi bidang kerja Jepang.','duration'=>'Sesuai program','is_featured'=>1,'sort_order'=>3],
 ['name'=>'Pembekalan Magang / Ikusei Shuro','slug'=>'pembekalan-magang-ikusei-shuro','category'=>'Kerja Jepang','short_description'=>'Pembekalan bahasa, disiplin, budaya dan kesiapan kerja bagi kandidat program Jepang.','duration'=>'Sesuai kebutuhan','is_featured'=>0,'sort_order'=>4],
 ]; foreach($programs as $p) Program::updateOrCreate(['slug'=>$p['slug']],$p);
 $faqs=[['question'=>'Apakah harus bisa bahasa Jepang sebelum mendaftar?','answer'=>'Tidak selalu. Peserta dapat mengikuti kelas dari tingkat dasar dan akan diarahkan sesuai target program.','sort_order'=>1],['question'=>'Apakah tersedia persiapan Tokutei Ginou?','answer'=>'Ya, program dapat mencakup pembekalan bahasa Jepang, kesiapan ujian, wawancara, dan budaya kerja sesuai kebutuhan bidang.','sort_order'=>2],['question'=>'Bagaimana proses pendaftaran?','answer'=>'Isi formulir pendaftaran, tim LPK melakukan verifikasi dan menghubungi calon peserta untuk tahapan berikutnya.','sort_order'=>3]]; foreach($faqs as $f) Faq::firstOrCreate(['question'=>$f['question']],$f);
 $settings=['site_name'=>'LPK Sakura Indonesia','tagline'=>'Belajar. Siap Kerja. Berangkat ke Jepang.','phone'=>'08xxxxxxxxxx','email'=>'info@lpksakura.id','address'=>'Alamat LPK Anda','whatsapp'=>'628xxxxxxxxxx','hero_title'=>'Langkah Nyata Menuju Jepang','hero_subtitle'=>'Pelatihan bahasa Jepang, budaya kerja, dan persiapan program kerja Jepang secara terarah.']; foreach($settings as $k=>$v) Setting::updateOrCreate(['key'=>$k],['value'=>$v]);
 }}
