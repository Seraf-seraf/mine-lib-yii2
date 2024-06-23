<?php
/** @var yii\web\View $this */
/** @var Books $model */
/** @var int $id */

use app\models\Books;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<section>
    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => Url::to(['library/update', 'id' => $id]),
        'method' => 'post',
        'options' => ['class' => 'opened-book open', 'id' => 'book-form']
    ]); ?>
    <div class="editor-wrapper">
        <?= $form->field($model, 'textarea_1')->textarea(['rows' => 10, 'maxlength' => 128, 'class' => 'page'])->label('1 страница', ['class' => 'visually-hidden']) ?>
        <?= $form->field($model, 'textarea_2')->textarea(['rows' => 10, 'maxlength' => 128, 'class' => 'page'])->label('2 страница', ['class' => 'visually-hidden']) ?>
        <strong>ⓘ</strong>
    </div>
    <div class="buttons-wrapper">
        <?=
        Html::tag('div',
            Html::a('Удалить', Url::to(['library/delete', 'id' => $id]), ['class' => 'title']),
            ['class' => 'mc-button red-btn']
        );
        ?>
        <?=
        Html::tag('div',
            Html::submitButton('Сохранить', ['class' => 'title save']),
            ['class' => 'mc-button']
        );
        ?>
    </div>
    <?php \yii\widgets\ActiveForm::end(); ?>
    <aside class="about-book" style="z-index: 99">
        <h3 class="visually-hidden">О книге</h3>
        <table>
            <tr>
                <th>Название:</th>
                <td><?= Html::encode($model->title); ?></td>
            </tr>
            <tr>
                <th>Авторы:</th>
                <td><?= Html::encode($model->authors); ?></td>
            </tr>
            <tr>
                <th>Год издания:</th>
                <td><?= Html::encode($model->year); ?></td>
            </tr>
        </table>
    </aside>
    <?php $this->registerJs("
        document.querySelector('.editor-wrapper strong').addEventListener('mouseover', function() {
            document.querySelector('.about-book').style.display = 'flex';
        });
    
        document.querySelector('.editor-wrapper strong').addEventListener('mouseout', function() {
            document.querySelector('.about-book').style.display = 'none';
        });
    "); ?>
</section>
