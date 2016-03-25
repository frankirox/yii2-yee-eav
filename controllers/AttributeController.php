<?php

namespace yeesoft\eav\controllers;

use yeesoft\controllers\admin\BaseController;

/**
 * AttributeController implements the CRUD actions for yeesoft\eav\models\EavAttribute model.
 */
class AttributeController extends BaseController
{
    public $modelClass = 'yeesoft\eav\models\EavAttribute';
    public $modelSearchClass = 'yeesoft\eav\models\search\EavAttributeSearch';

    public $disabledActions = ['view', 'bulk-activate', 'bulk-deactivate'];

    protected function getRedirectPage($action, $model = null)
    {
        switch ($action) {
            case 'update':
                return ['update', 'id' => $model->id];
                break;
            case 'create':
                return ['update', 'id' => $model->id];
                break;
            default:
                return parent::getRedirectPage($action, $model);
        }
    }
}