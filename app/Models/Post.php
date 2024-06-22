<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['post'];

    /**
     * この投稿を所有するユーザー。（ Userモデルとの関係を定義）
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * このポストに属する画像（Imageモデルとの関係）
     */
    public function image() {
        return $this->hasOne(Image::class);
    }

    /**
     * このポストをお気に入りにしたユーザー。
     */
    public function favorite_users() {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }
}
