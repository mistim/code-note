<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Setting;

/**
 * SettingSearch represents the model behind the search form about `common\models\Setting`.
 */
class SettingSearch extends Setting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'creator_id', 'editor_id'], 'integer'],
            [['var_key', 'value', 'created_at', 'updated_at', 'creator.username', 'editor.username'], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), [
            'creator.username',
            'editor.username',
        ]);
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
        $query = Setting::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['creator', 'editor']);

        $dataProvider->sort->attributes['creator.username'] = [
            'asc'  => ['creator.username' => SORT_ASC],
            'desc' => ['creator.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['editor.username'] = [
            'asc'  => ['editor.username' => SORT_ASC],
            'desc' => ['editor.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id'         => $this->id,
            'status'     => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'creator_id' => $this->creator_id,
            'editor_id'  => $this->editor_id,
        ]);

        $query->andFilterWhere(['like', 'var_key', $this->var_key])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'creator.username', $this->getAttribute('creator.username')])
            ->andFilterWhere(['like', 'editor.username', $this->getAttribute('editor.username')]);

        return $dataProvider;
    }
}
