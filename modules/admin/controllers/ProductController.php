<?php
namespace app\modules\admin\controllers;

use Yii;
use app\models\ProductSearch;

/**
 * Class ProductController
 * @package app\modules\admin\controllers
 */
class ProductController extends MainController
{
    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}