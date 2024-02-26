<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory,HasUuids;

    protected $table = 'notes';

    protected $guarded = ['id'];

    protected $fillable = [
        'title',
        'user_id',
        'body',
        'send_date',
        'is_published',
        'heart_count'
    ];
    public function user(){
        $this->belongsTo(User::class);
    }
    public function publishedNotes(User $user){
        return $this->where('user_id',$user->id)
            ->where('is_published',true)
            ->get();
    }
}
