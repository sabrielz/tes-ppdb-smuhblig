<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Config extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'value' => 'array'
    ];

    public $guarded = [
        'id',
        'key'
    ];

    public $fillable = [
        'value'
    ];

    /**
     * Parse configs data to assocative array
     * And save it forever in cache
     */
    public static function getConfigs () :array
    {
        return Cache::rememberForever('configs', function () :array {
            return Config::all()->groupBy('key')->map(function ($config) {
                return $config->first();
            })->toArray();
        });
    }

    /**
     * Get config value from key
     */
    public static function getConfig(string $key, mixed $default = [], array ...$options) :mixed
    {
        $configs = static::getConfigs();
        if (!$configs or empty($configs) or !array_key_exists($key, $configs)) return $default;

        $configs = $configs[$key];
        if (($options['get_value_only'] ?? true)) {
            $configs = $configs['value'];
        }

        return $configs;
        // return Cache::rememberForever("config_$key", fn() => $configs);
    }

}
