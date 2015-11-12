<?php

namespace frontend\widgets;

use Yii;
use yii\helpers\Html;
use yii\base\Widget;
use common\models\QuestionTag;

/**
 * Class TagsWidget
 * Render tags for models
 * @package frontend\widgets
 */
class TagsWidget extends Widget
{
    /**
     * If tags is null then will be set all models
     * @var QuestionTag[]|...
     */
    public $tags;

    /**
     * Url to controller/action by tag-name.
     * For example "qa/tag"
     * @var string
     */
    public $action;

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->tags) {
            foreach ($this->tags as $tag) {
                echo Html::a(Html::encode($tag->name), [$this->action, 'name' => $tag->name], ['class' => 'btn btn-default btn-sm']);
            }
        }
    }
}