<?php
/** @var yii\web\View $this */
/** @var Books $model */

use app\models\Books;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Создание';

?>

<section class="add">
    <?php $form = ActiveForm::begin([
        'id' => 'form-create',
    ]); ?>

    <?= $form->field($model, 'title'); ?>
    <?= $form->field($model, 'authors'); ?>
    <?= $form->field($model, 'year'); ?>

    <div class="buttons-wrapper" style="padding: 20px">
        <?=
        Html::tag('div',
            Html::tag('button',
                'Сохранить', ['class' => 'title']
            ),
            ['class' => 'mc-button']
        );
        ?>
        <?=
        Html::tag('div',
            Html::a('На главную', Yii::$app->homeUrl, ['class' => 'title']),
            ['class' => 'mc-button']
        );
        ?>
    </div>

    <?php ActiveForm::end(); ?>
</section>