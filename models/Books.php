<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $title
 * @property string|null $authors
 * @property int|null $year
 */
class Books extends \yii\db\ActiveRecord
{
    public const BOOKS_PER_SHELF = 10;
    public const MAX_COUNT_BOOKS = 30;

    public $textarea_1;
    public $textarea_2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['title', 'validateCountBooks'],
            [['title'], 'required', 'message' => 'Название не может быть пустым!'],
            [['title', 'authors'], 'string', 'max' => 64, 'tooLong' => 'Максимум {max} символа'],
            [['year'], 'integer'],
            [['textarea_1', 'textarea_2'], 'string', 'max' => 128, 'tooLong' => 'Максимум {max} символов'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'authors' => 'Авторы',
            'year' => 'Год выпуска',
            'text' => 'Текст'
        ];
    }

    public static function createShelves(): array
    {
        $books = self::find()->all();

        return array_chunk($books, self::BOOKS_PER_SHELF);
    }

    public static function getTextColumns($id)
    {
        $text = self::find()
            ->where(['id' => $id])
            ->select('text')
            ->one();

        if (!empty($text->text)) {
            return json_decode($text->text, true);
        }

        return null;
    }

    public function validateCountBooks()
    {
        $count = self::find()->count();

        if ($count >= self::MAX_COUNT_BOOKS) {
            $this->addError('title', "Можно создать максимум " . self::MAX_COUNT_BOOKS . " книг!");
        }
    }

    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->text = json_encode(['textarea_1' => $this->textarea_1, 'textarea_2' => $this->textarea_2]);
            return true;
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        if (!empty($this->text)) {
            $texts = json_decode($this->text, true);
            $this->textarea_1 = $texts['textarea_1'] ?? '';
            $this->textarea_2 = $texts['textarea_2'] ?? '';
        }
    }
}
