<?php declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Like
 *
 * @property int $id
 * @property int $user_id
 * @property int $comment_id
 * @method static Builder|Like newModelQuery()
 * @method static Builder|Like newQuery()
 * @method static Builder|Like query()
 * @method static Builder|Like whereCommentId($value)
 * @method static Builder|Like whereId($value)
 * @method static Builder|Like whereUserId($value)
 * @mixin Eloquent
 */
class Like extends Model
{
    public $timestamps = false;
}
