<?php

namespace app\components\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class CacheBehavior extends Behavior
{
    public $cacheKey;

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteCache',
            ActiveRecord::EVENT_AFTER_UPDATE => 'deleteCache',
            ActiveRecord::EVENT_AFTER_INSERT => 'deleteCache',
        ];
    }

    public function deleteCache()
    {
        \Yii::$app->cache->delete($this->cacheKey . "_" . $this->owner->getPrimaryKey());
    }
}