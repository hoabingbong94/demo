<?php

namespace app\models\bongda433;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bongda433\Categories;

/**
 * CategoriesSearch represents the model behind the search form about `app\models\bongda433\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CategoryID', 'ParentID', 'OrderIndex', 'Public', 'UserCreate', 'UserUpdate'], 'integer'],
            [['Logo', 'CategoryName', 'Title', 'TitleAlias', 'Keyword'], 'safe'],
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
        $query = Categories::find();

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
        $query->andFilterWhere([
            'CategoryID' => $this->CategoryID,
            'ParentID' => $this->ParentID,
            'OrderIndex' => $this->OrderIndex,
            'Public' => $this->Public,
            'UserCreate' => $this->UserCreate,
            'UserUpdate' => $this->UserUpdate,
        ]);

        $query->andFilterWhere(['like', 'Logo', $this->Logo])
            ->andFilterWhere(['like', 'CategoryName', $this->CategoryName])
            ->andFilterWhere(['like', 'Title', $this->Title])
            ->andFilterWhere(['like', 'TitleAlias', $this->TitleAlias])
            ->andFilterWhere(['like', 'Keyword', $this->Keyword]);

        return $dataProvider;
    }
}
