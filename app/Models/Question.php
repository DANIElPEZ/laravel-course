<?php

//the model represent the questions table in the database

namespace App\Models;

use App\Traits\HasHeart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Question extends Model
{
    use HasFactory, HasHeart, Sluggable;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class); //belong is used to define the relationship to other model
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    //this function is used to delete in cascade
    protected static function booted()
    {
        static::deleting(function ($question) {
            $question->hearts()->delete();
            $question->comments()->get()->each(function ($comment) {
                $comment->hearts()->delete();
                $comment->delete();
            });
            $question->answers()->get()->each(function ($answer) {
                $answer->hearts()->delete();
                $answer->comments()->get()->each(function ($comment) {
                    $comment->hearts()->delete();
                    $comment->delete();
                });
            });
        });
    }
}
