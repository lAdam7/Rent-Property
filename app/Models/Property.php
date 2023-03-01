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

        $query->when($filters['property_type'] ?? false, function($query, $propertyTypes) {
            $query->whereHas('type', fn($query) => $query->whereIn('id', $propertyTypes));

        });

        $query->when($filters['includes']['garden'] ?? false, function($query, $author) {
            $query->where('garden', true);
        });

        $query->when($filters['includes']['furnished'] ?? false, function($query, $author) {
            $query->where('furnished', true);
        });

        $query->when($filters['includes']['parking'] ?? false, function($query, $author) {
            $query->where('parking', true);
        });


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
