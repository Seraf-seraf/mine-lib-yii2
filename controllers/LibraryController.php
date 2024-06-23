<?php

namespace app\controllers;

use app\models\Books;
use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;

class LibraryController extends \yii\web\Controller
{
    public function actionAdd()
    {
        $model = new Books();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $model->save();
                return $this->goHome();
            }
        }

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        return $this->render('add', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        if ($book = Books::findOne(['id' => $id])) {
            $book->delete();
        }
        return $this->goHome();
    }

    public function actionIndex(): string
    {
        $shelves = Books::createShelves();

        return $this->render('index', ['shelves' => $shelves]);
    }

    public function actionUpdate($id)
    {
        $book = Books::findOne($id);

        if (Yii::$app->request->isPost) {
            if ($book !== null) {
                $book->load(Yii::$app->request->post());

                if ($book->validate()) {
                    $book->save();
                    return $this->goHome();
                }
            }
        }

        return $this->goHome();
    }

    public function actionShow($id)
    {
        if (Yii::$app->request->isAjax) {
            $text = Books::getTextColumns($id);
            $model = Books::findOne(['id' => $id]);

            return $this->renderAjax('show', ['id' => $id, 'text' => $text, 'model' => $model]);
        }

        return $this->goHome();
    }
}
