<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Sluggable\HasSlug;
// use Spatie\Sluggable\SlugOptions;

class Worker extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ["id"];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    protected $fillable = ['professional_experience', 'cover_image', 'id_number', 'address', 'experience_year', 'password', 'user_id', 'profession_id'];


    public function profession()
    {
        $this->belongsTo(Profession::class, 'profession_id', 'id');
    }
    public function gallery()
    {
        $this->hasOne(gallery::class, 'worker_id', 'id');
    }
    // public function getSlugOptions(): SlugOptions
    // {
    //     return SlugOptions::create()
    //         ->generateSlugsFrom(['id_number'])
    //         ->saveSlugsTo('slug')
    //         ->slugsShouldBeNoLongerThan(255)
    //         ->skipGenerateWhen(fn () => $this->delete_at != null);
    // }
    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
