<?php

namespace Brucelwayne\AI\Models;

use Mallria\Core\Models\BaseMongoModel;
use MongoDB\Laravel\Relations\MorphTo;

/**
 * @property $big_model_name
 * @property $model_type
 * @property $model_id
 * @property $response;
 */
class AiLogModel extends BaseMongoModel
{
    const TABLE = 'ai_logs';
    protected $collection = self::TABLE; // 指定集合名

    protected $fillable = [
        'big_model_name',
        'model_type', // 多态关系模型的类型
        'model_id', // 多态关系模型的 ID
        'response', // 日志内容
    ];

    // 定义多态关系
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
