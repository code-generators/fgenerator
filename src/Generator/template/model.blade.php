namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class {{ucfirst($model)}} extends Model
{
    protected $table        = "{{$tableName}}";
    protected $primaryKey   = "{{$primaryKey}}";
    protected $guarded      = [];
    protected $hidden       = [];

    //模型事件监听

    public static function boot()
    {
        parent::boot();

        //创建记录时候需要删除的缓存
        static::created(function($model) {

            self::forgetAllCache($model);

        });

        //更新记录时候需要删除的缓存
        static::updated(function($model) {

            self::forgetAllCache($model);

        });

        //删除记录时候需要删除的缓存
        static::deleted(function($model) {

            self::forgetAllCache($model);

        });
    }

    /**
     * 清除该模型所有缓存
     * @param $model
     */
    private static function forgetAllCache($model)
    {

    }
}