<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = ['name','nik','birth_place','birth_date','gender','phone','email','address','education','program_id','japanese_level','photo','ktp','ijazah','status','notes'];
    protected $casts = ['birth_date'=>'date'];

    public const STATUSES = [
        'baru' => 'Baru Masuk',
        'dihubungi' => 'Sudah Dihubungi',
        'seleksi' => 'Proses Seleksi',
        'lulus' => 'Lulus Seleksi',
        'ditolak' => 'Ditolak',
        'berangkat' => 'Berangkat',
    ];

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function whatsappUrl(): string
    {
        $phone = preg_replace('/\D/', '', (string) $this->phone);

        if (str_starts_with($phone, '0')) {
            $phone = '62'.substr($phone, 1);
        } elseif ($phone && ! str_starts_with($phone, '62')) {
            $phone = '62'.ltrim($phone, '0');
        }

        return 'https://wa.me/'.$phone;
    }

    public function program(){ return $this->belongsTo(Program::class); }
}
