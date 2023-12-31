<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'tagable');
    }


}
