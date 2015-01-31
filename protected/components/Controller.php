<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {
	/**
	 *
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 *      meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout = '//layouts/column1';
	/**
	 *
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array ();
	/**
	 *
	 * @var array the breadcrumbs of the current page. The value of this property will
	 *      be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 *      for more details on how to specify this property.
	 */
	public $breadcrumbs = array ();
	public function init() {
		parent::init ();
		// Remove any double slashes and force a trailing slash to the request URI
// 		$requestUri = yii::app ()->request->requestUri;
// 		$repairedRequestUri = $requestUri;
// 		while ( false !== strpos ( $repairedRequestUri, '//' ) ) {
// 			$repairedRequestUri = preg_replace ( "////", '/', $repairedRequestUri );
// 		}
// 		if (false === strpos ( $repairedRequestUri, '?' ) && '/' !== substr ( $repairedRequestUri, strlen ( $repairedRequestUri ) - 1, 1 )) {
// 			$repairedRequestUri = "{$repairedRequestUri}/";
// 		} elseif ('/' !== $requestUri {strlen ( $requestUri ) - 1}) {
// 			$repairedRequestUri = substr ( $repairedRequestUri, 0, strpos ( $repairedRequestUri, '?' ) ) . substr ( $repairedRequestUri, strpos ( $repairedRequestUri, '?' ) );
// 		}
// 		if ($repairedRequestUri !== $requestUri) {
// 			yii::app ()->request->redirect ( $repairedRequestUri, true, 301 );
// 		}
		$this->updateCache();
	}

	private function updateCache() {
		if(Yii::app()->request->getParam('cache', 'true') === 'false')
			Yii::app()->setComponent('cache', new CDummyCache());
	}
}