<?php

use frontend\widgets\TagsWidget;
use yii\helpers\Html;
use yii\helpers\Markdown;
use yii\helpers\HtmlPurifier;
use common\helpers\Generator;

/* @var $question \common\models\Question */

?>
<div class="question-item">
    <div class="row q-row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 q-left">

            <?= Html::a(Html::encode($question->title), ['/qa/view', 'id' => $question->id], ['class' => 'post-title']); ?>

            <div class="post-info">
                <?= Yii::$app->formatter->asDate($question->created_at); ?> <span class="margin-line">|</span>
                <?= Html::a(Html::encode($question->user->username), ['profile/view', 'id' => $question->user->id]); ?>
                <?= $question->solution ? '<span class="ico_true ico_true_green"><svg><use xlink:href="#ico_true" /></svg> ' . Yii::t('qa', 'Resolve') . '</span>' : '' ?>
            </div>

            <div class="q-description">
                <?= HtmlPurifier::process(
                    Markdown::process(Generator::limitWords($question->body, 40), 'gfm-comment')
                ) ?>
            </div>

            <div class="q-tags">
                <?= TagsWidget::widget(['tags' => $question->questionTags]) ?>
            </div>
        </div>

        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 q-right">
            <div class="q-answer <?= ($question->answer_count > 0) ? 'green' : '' ?>">
                <div class="q-number"><?= $countAnswers = $question->answer_count ?></div>
                <?= \Yii::t('qa', '{n, plural, =0{answers} =1{answer} other{answers}}', ['n' => $countAnswers]) ?>
            </div>
            <div class="q-info">
                <div class="q-info-like">
                    <svg>
                        <use xlink:href="#ico_like"/>
                    </svg>
                    <span><?= $question->favorite_count ?> </span>
                </div>
                <div class="q-info-view">
                    <svg>
                        <use xlink:href="#ico_view"/>
                    </svg>
                    <span><?= $question->view_count ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
