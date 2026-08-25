<?php
namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function create(){
        return view('pages.registration',[
            'programs'=>Program::where('is_active',1)->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request){
        $data=$request->validate([
            'name'=>'required|string|max:150',
            'nik'=>'required|string|max:30',
            'birth_place'=>'required|string|max:100',
            'birth_date'=>'required|date',
            'gender'=>'required|in:L,P',
            'phone'=>'required|string|max:30',
            'email'=>'required|email|max:150',
            'address'=>'required|string|max:1000',
            'education'=>'required|string|max:100',
            'program_id'=>'required|exists:programs,id',
            'japanese_level'=>'required|string|max:50',
            'photo'=>'required|image|mimes:jpg,jpeg,png|max:5120',
            'ktp'=>'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'ijazah'=>'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ],[
            'nik.required'=>'NIK KTP wajib diisi.',
            'birth_place.required'=>'Tempat lahir wajib diisi.',
            'birth_date.required'=>'Tanggal lahir wajib diisi.',
            'gender.required'=>'Jenis kelamin wajib dipilih.',
            'education.required'=>'Pendidikan wajib diisi.',
            'japanese_level.required'=>'Level Jepang wajib dipilih.',
            'email.required'=>'Email wajib diisi.',
            'address.required'=>'Alamat wajib diisi.',
            'program_id.required'=>'Program wajib dipilih.',
            'photo.required'=>'Pas foto wajib diupload.',
            'ktp.required'=>'File KTP wajib diupload.',
            'ijazah.required'=>'File ijazah wajib diupload.',
        ]);

        $data['photo']=$request->file('photo')->store('registrations/photos','public');
        $data['ktp']=$request->file('ktp')->store('registrations/ktp','public');
        $data['ijazah']=$request->file('ijazah')->store('registrations/ijazah','public');
        $data['status']='baru';

        Registration::create($data);

        return redirect()->route('registration.create')->with('success','Pendaftaran berhasil dikirim. Tim LPK akan menghubungi Anda.');
    }
}
