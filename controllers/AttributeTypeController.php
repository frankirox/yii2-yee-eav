<?php

namespace yeesoft\eav\controllers;

use yeesoft\controllers\admin\BaseController;

/**
 * AttributeTypeController implements the CRUD actions for yeesoft\eav\models\EavAttributeType model.
 */
class AttributeTypeController extends BaseController
{
    public $modelClass = 'yeesoft\eav\models\EavAttributeType';
    public $modelSearchClass = 'yeesoft\eav\models\search\EavAttributeTypeSearch';

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