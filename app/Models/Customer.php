<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Customer extends Model
{
    use HasFactory, HasSlug;
    protected $fillable = ['user_id', 'Whatsapp_number', 'phone_number', 'id_number', 'address', 'birthDate', 'gender'];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getSlugOptions(): SlugOptions
    {
        //Build slug from name column and store slug column max length 255 and skip slug when deleted_at null

        return SlugOptions::create()
            ->generateSlugsFrom(['phone_number'])
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(15)
            ->skipGenerateWhen(fn () => $this->deleted_at !== null);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
