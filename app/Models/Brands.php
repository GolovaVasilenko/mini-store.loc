<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Brands extends Model
{
    use Sluggable;

    protected $fillable = ['name'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @param $image
     */
    public function uploadImage($image)
    {
        if($image == null) return;
        $this->removeImage();
        $fileName = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $fileName);
        $this->image = $fileName;
        $this->save();
    }

    public function getImage()
    {
        if(null == $this->image){
            return '/images/no-image.png';
        }
        return '/uploads/' . $this->image;
    }

    public function removeImage()
    {
        if($this->aimage != null){
            Storage::delete('uploads/'. $this->image);
        }
    }
}
