<?php declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Follow
 *
 * @method static Builder|Follow newModelQuery()
 * @method static Builder|Follow newQuery()
 * @method static Builder|Follow query()
 * @mixin Eloquent
 * @property int $id
 * @property int $follower
 * @property int $receiver
 * @method static Builder|Follow whereFollower($value)
 * @method static Builder|Follow whereId($value)
 * @method static Builder|Follow whereReceiver($value)
 */
class Follow extends Model
{
    public $timestamps = false;
}
