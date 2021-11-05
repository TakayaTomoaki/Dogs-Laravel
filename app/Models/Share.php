<?php declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Share
 *
 * @property int $id
 * @property int $user_id
 * @property string $body
 * @property string|null $image
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Share newModelQuery()
 * @method static Builder|Share newQuery()
 * @method static Builder|Share query()
 * @method static Builder|Share whereBody($value)
 * @method static Builder|Share whereCreatedAt($value)
 * @method static Builder|Share whereDeletedAt($value)
 * @method static Builder|Share whereId($value)
 * @method static Builder|Share whereImage($value)
 * @method static Builder|Share whereUpdatedAt($value)
 * @method static Builder|Share whereUserId($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Share onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Share withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Share withoutTrashed()
 */
class Share extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'body'
    ];

    public function user_id(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }
}
