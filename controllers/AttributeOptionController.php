<?php

namespace yeesoft\eav\controllers;

use yeesoft\controllers\admin\BaseController;

/**
 * AttributeOptionController implements the CRUD actions for yeesoft\eav\models\EavAttributeOption model.
 */
class AttributeOptionController extends BaseController
{
    public $modelClass = 'yeesoft\eav\models\EavAttributeOption';
    public $modelSearchClass = 'yeesoft\eav\models\search\EavAttributeOptionSearch';

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