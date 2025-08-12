<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'name',
        'slug',
        'description',
        'content',
        'active',
        'updated_at',
        'created_at'
    ];

    public function book(){
        return $this->hasOne(Book::class, 'id', 'book_id')->withDefault(['name' => '']);
    }

    public function nextChapter()
    {
        return self::where('book_id', $this->book_id)
                ->where('id', '>', $this->id)
                ->orderBy('id', 'asc')
                ->first();
    }

    public function previousChapter()
    {
        return self::where('book_id', $this->book_id)
                ->where('id', '<', $this->id)
                ->orderBy('id', 'desc')
                ->first();
    }
}
