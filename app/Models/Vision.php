<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => 'string',
        'image' => 'string',
        'response' => 'array',
    ];

    public function getImageBase64(): string
    {
        $imagePath = storage_path('app/public/' . $this->image);

        return base64_encode(file_get_contents($imagePath));
    }
}
