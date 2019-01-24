<?php

namespace backend\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AuthAssign as AuthAssignModel;

/**
 * AuthAssign represents the model behind the search form of `app\models\AuthAssign`.
 */
class AuthAssign extends AuthAssignModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'assign'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $assign)
    {
        $query = AuthAssignModel::find()
        ->where(['assign' => $assign]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith(['user']);

        $query->andFilterWhere(['like', 'user.username', $this->id_user])
            ->andFilterWhere(['like', 'user.email', $this->assign]);

        return $dataProvider;
    }
}
