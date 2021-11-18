<?php declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Nice
 *
 * @property int $id
 * @property int $user_id
 * @property int $share_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Nice newModelQuery()
 * @method static Builder|Nice newQuery()
 * @method static Builder|Nice query()
 * @method static Builder|Nice whereCreatedAt($value)
 * @method static Builder|Nice whereId($value)
 * @method static Builder|Nice whereShareId($value)
 * @method static Builder|Nice whereUpdatedAt($value)
 * @method static Builder|Nice whereUserId($value)
 * @mixin Eloquent
 */
class Nice extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'user_id', 'share_id'
    ];
}
