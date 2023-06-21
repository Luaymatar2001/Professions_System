<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Image extends Model
{
    use HasFactory, HasSlug;
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $appends = ['check_active'];
    protected $guarded = ["id"];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = ['image_url',  'galleries_id', 'accept', 'reject_reason'];

    public function gallery()
    {
        $this->belongsTo(gallery::class, 'gallery_id', 'id');
    }

    public function image()
    {
        $this->hasMany(Image::class, 'gallery_id', 'id');
    }

    public function getCheckActiveAttribute()
    {
        return $this->accept ? 'active' : 'In-Active';
    }
    public function getSlugOptions(): SlugOptions
    {
        //Build slug from name column and store slug column max length 255 and skip slug when deleted_at null

        return SlugOptions::create()
            ->generateSlugsFrom(['image_url'])
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(255)
            ->skipGenerateWhen(fn () => $this->deleted_at !== null);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
