<?php
/** @var yii\web\View $this */
/** @var array $shelves */

use yii\helpers\Html;
use yii\helpers\Url;
use Texture\BookTexture;

$this->title = 'Главная';

?>
<section>
    <h2 class="visually-hidden">Главная</h2>
    <div class="shelf-wrapper">
        <?php foreach ($shelves as $shelf): ?>
            <div class="book-shelf">
                <!-- Верхняя полка -->
                <div class="shelf-row">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <?php if (isset($shelf[$i])): ?>
                            <div class="book <?= BookTexture::getHTMLClass() ?>"
                            data-id="<?= $shelf[$i]->id ?>" title="<?= $shelf[$i]->title ?>">
                            </div>
                        <?php else: break; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <!-- Нижняя полка -->
                <div class="shelf-row">
                    <?php for ($i = 5; $i < 10; $i++): ?>
                        <?php if (isset($shelf[$i])): ?>
                            <div class="book <?= BookTexture::getHTMLClass() ?>"
                            data-id="<?= $shelf[$i]->id ?>" title="<?= $shelf[$i]->title ?>">
                            </div>
                        <?php else: break; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="buttons-wrapper">
        <?=
        Html::tag('div',
            Html::a('Добавить книгу', Url::to(['library/add']), ['class' => 'title']),
            ['class' => 'mc-button add-book']
        );
        ?>
    </div>
</section>
<?php  $this->registerJs("  
    $(document).on('click', '.book', function() {
        const bookId = $(this).data('id');
        const title = $(this).attr('title');
        if (bookId) {
            $.ajax({
                url: '" . Url::to('library/show') . "',
                type: 'GET',
                data: {id: bookId},
                success: function(data) {
                    document.title = title;
                    $('.container').html(data);
                    $('#book-modal').css('display', 'block');
                }
            });
        }
    });

    $(window).on('click', function(event) {
        if (event.target == document.getElementById('book-modal')) {
            $('#book-modal').css('display', 'none');
        }
    });
    
");?>
