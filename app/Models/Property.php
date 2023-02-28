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
