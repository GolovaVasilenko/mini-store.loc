<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public const STRING_TYPE = 'string';
    public const IMAGE_TYPE = 'image';
    public const MULTIPLE_TYPE = 'list';

    protected $fillable = ['name', 'key', 'type'];

    public static function getTypeList()
    {
        return [
          self::STRING_TYPE,
          self::IMAGE_TYPE,
          self::MULTIPLE_TYPE
        ];
    }

    public static function add($fields)
    {
        $setting = new self();
        $setting->fill($fields);

        if($setting->isMultipleType()){
            $setting->value = serialize($fields['value']);
        }
        else {
            $setting->value = $fields['value'];
        }

        $setting->save();

        return $setting;
    }

    /**
     * @return bool
     */
    public function isImageType()
    {
        return $this->type === self::IMAGE_TYPE;
    }

    /**
     * @return bool
     */
    public function isMultipleType()
    {
        return $this->type === self::MULTIPLE_TYPE;
    }

    /**
     * @return bool
     */
    public function isStringType()
    {
        return $this->type === self::STRING_TYPE;
    }

}
