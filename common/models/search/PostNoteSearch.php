<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PostNote;

/**
 * PostNoteSearch represents the model behind the search form about `common\models\PostNote`.
 */
class PostNoteSearch extends PostNote
{
	/** @var integer */
	public $tag_id;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['id', 'status', 'category_id', 'creator_id', 'editor_id', 'tag_id', 'is_post'], 'integer'],
			[
				[
					'title', 'alias', 'teaser', 'text', 'image', 'posted_at', 'created_at', 'updated_at',
					'creator.username', 'editor.username', 'category.title',
				],
				'safe',
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
		$query = PostNote::find();

		// add conditions that should always apply here

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$query->joinWith(['creator', 'editor', 'category', 'postTags', 'noteTags']);

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
			'id'          => $this->id,
			'status'      => $this->status,
			'posted_at'   => $this->posted_at,
			'category_id' => $this->category_id,
			'creator_id'  => $this->creator_id,
			'editor_id'   => $this->editor_id,
			'created_at'  => $this->created_at,
			'updated_at'  => $this->updated_at,
			'is_post'     => $this->is_post,
		]);

		if ($this->tag_id) {
			$query->andFilterWhere([
				'post_tag.tag_id' => $this->tag_id,
				'note_tag.tag_id' => $this->tag_id
			]);
		}

		$query->andFilterWhere(['like', 'title', $this->title])
			->andFilterWhere(['like', 'alias', $this->alias])
			->andFilterWhere(['like', 'teaser', $this->teaser])
			->andFilterWhere(['like', 'text', $this->text])
			->andFilterWhere(['like', 'image', $this->image])
			->andFilterWhere(['like', 'creator.username', $this->getAttribute('creator.username')])
			->andFilterWhere(['like', 'editor.username', $this->getAttribute('editor.username')]);

		return $dataProvider;
	}
}