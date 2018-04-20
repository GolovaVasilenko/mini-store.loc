<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public const STRING_TYPE = 'string';
    public const IMAGE_TYPE = 'image';
    public const MULTIPLE_TYPE = 'multiple';

    protected $fillable = ['name', 'key', 'value', 'type'];

    public function getTypeList()
    {
        return [
          self::STRING_TYPE,
          self::IMAGE_TYPE,
          self::MULTIPLE_TYPE
        ];
    }

    public function isImageType()
    {
        return $this->type === self::IMAGE_TYPE;
    }

    public function isMultipleType()
    {
        return $this->type === self::MULTIPLE_TYPE;
    }

    public function isStringType()
    {
        return $this->type === self::STRING_TYPE;
    }
}
