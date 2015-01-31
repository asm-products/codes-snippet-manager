<?php

class ThoughtcastController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','snippets','thought','AjaxGetUserID','SaveSnippets','GetSnippets','GetSnippet','ArchiveSnippet','DeleteSnippet','CountSnippets' ,'GetLabels','UpdateLabels','CountArchiveSnippets'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','home'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Thoughtcast;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Thoughtcast']))
		{
			$model->attributes=$_POST['Thoughtcast'];
		
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Thoughtcast']))
		{
			$model->attributes=$_POST['Thoughtcast'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	$this->pageTitle = "Codes";
		$dataProvider=new CActiveDataProvider('Thoughtcast');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Thoughtcast('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Thoughtcast']))
			$model->attributes=$_GET['Thoughtcast'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Thoughtcast the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Thoughtcast::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Thoughtcast $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='thoughtcast-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionHome()
	{
		if(!Yii::app()->user->isGuest) {
		$dataProvider=new CActiveDataProvider('Thoughtcast');
		$this->render('home',array(
			'dataProvider'=>$dataProvider,
		));
		}
		else {
			$this->redirect(array('thoughtcast/index'));
		}
	}
	public function actionSnippets() {
	$this->pageTitle = "Codes - Snippets";
		if(!Yii::app()->user->isGuest) {
		$dataProvider=new CActiveDataProvider('Thoughtcast');
		$this->render('snippets',array(
			'dataProvider'=>$dataProvider,
		));
		}
		else {
			$this->redirect(array('thoughtcast/index'));
		}
	}
	public function actionThought() {
	if(1) {
		$dataProvider=new CActiveDataProvider('Thoughtcast');
		$this->render('thought',array(
			'dataProvider'=>$dataProvider,
		));
		}
		else {
			$this->redirect(array('thoughtcast/index'));
		}
	}
	public function actionAjaxGetUserID() {
		echo Yii::app()->user->id;

	}
	public function actionSaveSnippets(){
		$post = file_get_contents("php://input");
		$data = json_decode($post);
		if($data->id =="" || $data->id ==NULL) {
				$thought = new Thoughtcast;
		}
		else {
			$thought=Thoughtcast::model()->findByPk(intval($data->id));
		}
		$thought->user_id = Yii::app()->user->id;
		$thought->content = $data->snippet;
		
		$thought->title = $data->title;
		$thought->excerpt = $data->excerpt;
		$thought->date_added = 	strtotime(date('Y-m-d H:i:s'));
		$thought->type = $data->type;
		$thought->cast_type = "snippet";
		$thought->archive = 0;
		$thought->category_id =  "-1"; 
// 		if(isset($_POST["labels"]) || $_POST["labels"]=="")
		$thought->category_id =  $data->labels; 
		$thought->save(false);
		echo json_encode(array("id"=>$thought->id));
	}
	public function actionGetSnippets() {
		$limit = isset($_GET["limit"]) ? Yii::app()->input->get("limit") : 10;
		$archive = isset($_GET["archive"]) ? Yii::app()->input->get("archive") : 0;
		$uid = Yii::app()->user->id;
		$offset =  isset($_GET["offset"]) ? Yii::app()->input->get("offset") : 0;
		
		if(isset($_GET["query"])) {
		
		$search_term = Yii::app()->input->get("query");
		if($search_term!="") {
		$sql = 'select id,excerpt,title,type,FROM_UNIXTIME(date_added,"%d/%m/%Y") as date_added,archive,type,cast_type,category_id as labels from icbac_thoughtcast ';
		$sql.=	"where user_id = $uid and cast_type='snippet' and archive = $archive and";
		$sql.= " (title like '%". $search_term. "%' or excerpt like '%". $search_term. "%' or content like '%". $search_term. "%') order by id DESC limit  $limit offset $offset"	;
		}
		else {
		$sql = 'select id,excerpt,title,type,FROM_UNIXTIME(date_added,"%d/%m/%Y") as date_added,archive,type,cast_type,category_id as labels from icbac_thoughtcast ';
		$sql.=	"where user_id=$uid and cast_type='snippet' and archive=$archive ";
		$sql.=	 " order by id DESC limit $limit offset $offset";
		}
		$snippets = Yii::app()->db->createCommand($sql)->queryAll();
		echo json_encode($snippets);
		}
	}
	
	public function actionGetSnippet() {
		if(isset($_GET["id"]))
		$thought=Thoughtcast::model()->findByPk(Yii::app()->input->get("id"));
		if($thought->user_id==Yii::app()->user->id){
			$content = array("content"=> $thought->content,"labels"=>$thought->category_id);
			
			echo json_encode($content);
		}
		
	}
	
	public function actionArchiveSnippet() {
		$post = file_get_contents("php://input");
		$data = json_decode($post);
		error_log($data->id);
		if(isset($data->id)) {
			$thought = Thoughtcast::model()->findByPk(intval($data->id));
			if($thought->user_id==Yii::app()->user->id){
			$thought->archive = 1;
			$thought->save(false);
			}
		}
	}
	public function actionDeleteSnippet() {
		$post = file_get_contents("php://input");
		$data = json_decode($post);
		
		if(isset($data->id)){
			$thought = Thoughtcast::model()->findByPk(intval($data->id));
			if($thought->user_id==Yii::app()->user->id){
			$thought->delete();
			}

		}
	}
	public function actionCountSnippets() {
		
		$uid = Yii::app()->user->id;
		$sql = "select count(*) as total from icbac_thoughtcast where user_id = $uid and archive = 0";
		$snippets = Yii::app()->db->createCommand($sql)->queryAll();
		echo json_encode($snippets);
	}
	public function actionCountArchiveSnippets() {
		
		$uid = Yii::app()->user->id;
		$sql = "select count(*) as total from icbac_thoughtcast where user_id = $uid and archive = 1";
		$snippets = Yii::app()->db->createCommand($sql)->queryAll();
		echo json_encode($snippets);
	}
	public function actionDownloadSnippet() {
		if(isset($_POST["id"])) {
			$thought = Thoughtcast::model()->findByPk(Yii::app()->input->post("id"));
		}
	}
	public function actionGetLabels() {
		$uid =  Yii::app()->user->id;
		$labels = Yii::app()->db->createCommand()->select('*')
				 ->from('icbac_labels')
				 ->where("user_id=:uid",array(':uid'=>$uid))
				 ->queryAll();
				 
		echo json_encode($labels);
	}
	public function actionUpdateLabels() {
		$post = file_get_contents("php://input");
		$data = json_decode($post);
		if(isset($data->ids)) {
				$id_array = $data->ids;
				$id_array =  explode(",",$id_array);
				$names = $data->names;
				$names = explode(",",$names);
				$length = count($id_array);
				for($i=0;$i<$length;$i++) {
						$labels = IcbacLabels::model()->findByPk($id_array[$i]);
						$labels->label_name = $names[$i];
						$labels->save(false);
				}
		}
	}
}