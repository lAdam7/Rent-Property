<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyFrequency;
use App\Models\PropertyType;
use App\Models\User;

class Property extends Model
{
    use HasFactory;
    protected $table = 'properties';

    protected $guarded = [];

    public function scopeFilter($query, array $filters) // Post::newqUERY->FILTER
    {
        $query->when($filters['search'], function($query, $search) {
            $query->where(fn($query) =>
                $query->where('town_or_city', 'like', '%' . $search . '%')
                ->orWhere('street', 'like', '%' . $search . '%')
            );
        });

        // $query->when($filters['category'] ?? false, function($query, $category) {
        //     $query->whereHas('category', fn($query) => $query->where('slug', $category));
        //     /*
        //     $query->whereExists(fn($query) => 
        //         $query->from('categories')
        //         ->whereColumn('categories.id', 'posts.category_id')
        //         ->where('categories.slug', $category)
        // );*/
        // });

        // $query->when($filters['author'] ?? false, function($query, $author) {
        //     $query->whereHas('author', fn($query) => $query->where('username', $author));
        // });


    }

    public function frequency()
    {
        return $this->belongsTo(PropertyFrequency::class, 'property_frequency_id');
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function landlord()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
