<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * @var string Дата публикации. От.
     */
    public $date_from;
    /**
     * @var string Дата публикации. До.
     */
    public $date_to;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_from', 'date_to'], 'default', 'value' => null],
            [['author_id'], 'integer'],
            [['name'], 'string'],
            [['date_from', 'date_to'], 'date', 'format' => 'php:' . self::PHP_DATE_FORMAT]
        ];
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
        $query = Book::find();

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

        // grid filtering conditions
        $query->andFilterWhere(['author_id' => $this->author_id]);

        $query->andFilterWhere(['>', 'date', $this->date_from]);
        $query->andFilterWhere(['<', 'date', $this->date_to]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'date_from' => 'Дата выхода книги. От',
            'date_to' => 'Дата выхода книги. До',
        ]);
    }
}
