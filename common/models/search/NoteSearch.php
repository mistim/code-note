<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Note;

/**
 * NoteSearch represents the model behind the search form about `common\models\Note`.
 */
class NoteSearch extends Note
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'category_id', 'creator_id', 'editor_id'], 'integer'],
            [
                [
                    'title', 'alias', 'teaser', 'content', 'posted_at', 'category.title',
                    'created_at', 'updated_at', 'creator.username', 'editor.username'
                ],
                'safe'
            ],
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
            'category.title',
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
        $query = Note::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['creator', 'editor', 'category']);

        $dataProvider->sort->attributes['creator.username'] = [
            'asc'  => ['creator.username' => SORT_ASC],
            'desc' => ['creator.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['editor.username'] = [
            'asc'  => ['editor.username' => SORT_ASC],
            'desc' => ['editor.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['category.title'] = [
            'asc'  => ['category.title' => SORT_ASC],
            'desc' => ['category.title' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'posted_at' => $this->posted_at,
            'category_id' => $this->category_id,
            'creator_id' => $this->creator_id,
            'editor_id' => $this->editor_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'teaser', $this->teaser])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'creator.username', $this->getAttribute('creator.username')])
            ->andFilterWhere(['like', 'editor.username', $this->getAttribute('editor.username')])
            ->andFilterWhere(['like', 'category.title', $this->getAttribute('category.title')]);

        return $dataProvider;
    }
}
