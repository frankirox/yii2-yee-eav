<?php

namespace yeesoft\eav\models\search;

use yeesoft\eav\models\EavEntityModel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * EavEntityModelSearch represents the model behind the search form about `yeesoft\eav\models\EavEntityModel`.
 */
class EavEntityModelSearch extends EavEntityModel
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['entity_name', 'entity_model'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EavEntityModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'entity_name', $this->entity_name])
                ->andFilterWhere(['like', 'entity_model', $this->entity_model]);

        return $dataProvider;
    }

}
