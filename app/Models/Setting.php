<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    protected $fillable=['key','value'];

    public static function getValue(string $key, $default=null){
        return static::where('key',$key)->value('value') ?? $default;
    }

    public static function plucked(): array {
        return static::pluck('value','key')->toArray();
    }

    public static function localized(array $settings, string $key, $default=null, ?string $locale=null){
        $locale ??= app()->getLocale();
        $localizedKey = $locale === 'id' ? $key : "{$key}_{$locale}";

        if (!empty($settings[$localizedKey])) {
            return $settings[$localizedKey];
        }

        return $settings[$key] ?? $default;
    }

    public static function whatsappUrl(?string $number=null): ?string {
        $phone=preg_replace('/\D/','',(string) ($number ?? static::getValue('whatsapp','')));
        if(!$phone) return null;
        if(str_starts_with($phone,'0')) $phone='62'.substr($phone,1);
        elseif(!str_starts_with($phone,'62')) $phone='62'.ltrim($phone,'0');
        return 'https://wa.me/'.$phone;
    }
}
