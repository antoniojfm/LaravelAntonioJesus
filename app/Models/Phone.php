<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Phone
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Phone newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phone newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Phone query()
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Phone whereUserId($value)
 * @mixin \Eloquent
 */
class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','phone_number'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
