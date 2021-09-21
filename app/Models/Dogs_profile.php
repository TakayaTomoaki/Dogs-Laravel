<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Dogs_profile
 *
 * @property int $id
 * @property int $user_id
 * @property string $dog_name
 * @property string $dog_birthday
 * @property int $dog_gender
 * @property int $dog_weight
 * @property string|null $dog_father
 * @property string|null $dog_mother
 * @property string|null $dog_introduction
 * @property string|null $dog_image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereDogBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereDogFather($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereDogGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereDogImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereDogIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereDogMother($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereDogName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereDogWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dogs_profile whereUserId($value)
 * @mixin \Eloquent
 */
class Dogs_profile extends Model
{
    protected $table = 'dogs_profiles';

    protected $guarded = ['id'];

    public static $rules = [
        'dog_name' => 'required',
        'dog_birthday' => 'required',
        'dog_gender' => 'required',
        'dog_weight' => 'required',
        'dog_father' => 'required',
        'dog_mother' => 'required',
    ];

    public function user_id()
    {
        return belongsTo('App\User');
    }
}
