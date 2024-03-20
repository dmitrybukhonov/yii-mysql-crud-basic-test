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
use app\modules\bookcatalog\models\Book;
use app\modules\bookcatalog\models\forms\BookForm;
use app\modules\bookcatalog\components\AuthorDropdown;
use app\modules\bookcatalog\repositories\BookRepository;

class BookController extends BaseController
{
    /**
     * @var BookRepository
     */
    private $repository;

    public function __construct($id, $module, BookRepository $repository, $config = [])
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
     * @param integer $id
     * @return string
     */
    public function actionView(int $id): string
    {
        $book = $this->repository->getById($id);

        if (!$book) {
            throw new NotFoundHttpException("Book with ID $id not found");
        }

        return $this->render('view', [
            'book' => $book,
        ]);
    }

    /**
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new BookForm();

        return $this->proceed($model);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     * @throws Throwable
     */
    public function actionUpdate(int $id)
    {
        /** @var Book */
        $book = $this->repository->getById($id);

        if (!$book) {
            throw new NotFoundHttpException('Материал не найден');
        }

        $model = new BookForm($book);

        return $this->proceed($model);
    }

    /**
     * @throws NotFoundHttpException
     * @throws BadRequestHttpException
     */
    public function actionDelete(int $id)
    {
        /** @var Book */
        $model = $this->repository->getById($id);

        if (!$model) {
            throw new NotFoundHttpException('Материал не найден');
        }

        if ($this->repository->delete($model)) {
            $this->alertSuccess('Материал успешно удален');

            return $this->redirect(['book/index']);
        }

        $this->alertWarning('Произошла ошибка при удалении материала');

        return $this->refresh();
    }

    /**
     * @param BookForm $model
     * @return string|Response
     */
    private function proceed(BookForm $model)
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $model->load($request->post());
            return $this->asJson(ActiveForm::validate($model));
        }

        if ($model->load($request->post()) && $model->validate()) {
            if ($model->save()) {
                $this->alertSuccess('Сохранение выполнено успешно');

                return $this->redirect(['book/update', 'id' => $model->id]);
            }

            $this->alertDanger('Произошла ошибка при сохранении');
        }

        $authorList = (new AuthorDropdown)->getList();

        return $this->render('model', [
            'model' => $model,
            'authorList' => $authorList,
        ]);
    }
}
