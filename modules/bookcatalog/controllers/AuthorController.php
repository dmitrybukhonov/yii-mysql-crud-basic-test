<?php

namespace app\modules\bookcatalog\controllers;

use Yii;
use Throwable;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use app\controllers\web\BaseController;
use app\modules\bookcatalog\models\Author;
use app\modules\bookcatalog\models\forms\AuthorForm;
use app\modules\bookcatalog\repositories\AuthorRepository;

class AuthorController extends BaseController
{
    /**
     * @var AuthorRepository
     */
    private $repository;

    public function __construct($id, $module, AuthorRepository $repository, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->repository = $repository;
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->repository->getModel(),
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return string
     */
    public function actionTop(): string
    {
        $topAuthors = $this->repository->getTop();

        return $this->render('top', [
            'topAuthors' => $topAuthors,
        ]);
    }


    /**
     * @param integer $id
     * @return string
     */
    public function actionView(int $id): string
    {
        $author = $this->repository->getById($id);

        if (!$author) {
            throw new NotFoundHttpException('Материал не найден');
        }

        return $this->render('view', [
            'author' => $author,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $author = new AuthorForm();

        return $this->proceed($author);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     * @throws Throwable
     */
    public function actionUpdate(int $id)
    {
        /** @var Author */
        $author = $this->repository->getById($id);

        if (!$author) {
            throw new NotFoundHttpException('Материал не найден');
        }

        $model = new AuthorForm($author);

        return $this->proceed($model);
    }

    /**
     * @throws NotFoundHttpException
     * @throws BadRequestHttpException
     */
    public function actionDelete(int $id)
    {
        /** @var Author */
        $model = $this->repository->getById($id);

        if (!$model) {
            throw new NotFoundHttpException('Материал не найден');
        }

        if ($this->repository->delete($model)) {
            $this->alertSuccess('Материал успешно удален');

            return $this->redirect(['author/index']);
        }

        $this->alertWarning('Произошла ошибка при удалении материала');

        return $this->refresh();
    }

    /**
     * @param AuthorForm $model
     * @return string|Response
     */
    private function proceed(AuthorForm $model)
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $model->load($request->post());
            return $this->asJson(ActiveForm::validate($model));
        }

        if ($model->load($request->post()) && $model->validate()) {
            if ($model->save()) {
                $this->alertSuccess('Сохранение выполнено успешно');

                return $this->redirect(['author/update', 'id' => $model->id]);
            }

            $this->alertDanger('Произошла ошибка при сохранении');
        }

        return $this->render('model', [
            'model' => $model,
        ]);
    }
}
