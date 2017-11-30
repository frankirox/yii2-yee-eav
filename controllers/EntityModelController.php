<?php

namespace yeesoft\eav\controllers;

use yeesoft\controllers\CrudController;

/**
 * EavEntityModelController implements the CRUD actions for yeesoft\eav\models\EavEntityModel model.
 */
class EntityModelController extends CrudController
{
    public $modelClass = 'yeesoft\eav\models\EavEntityModel';
    public $modelSearchClass = 'yeesoft\eav\models\search\EavEntityModelSearch';

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