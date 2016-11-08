<?php

namespace app\modules\app90phut\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\app90phut\models\SoccerLeagueInfo;

/**
 * SoccerLeagueInfoSearch represents the model behind the search form about `app\modules\app90phut\models\SoccerLeagueInfo`.
 */
class SoccerLeagueInfoSearch extends SoccerLeagueInfo {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ID', 'Display_Order', 'CategoryID'], 'integer'],
            [['Name', 'Logo', 'CurrentRound', 'Code_Param1', 'Code_Param2', 'Code_Param3', 'Code_Param4', 'Code_Param5', 'Code_Param6', 'Name_VN', 'BXH', 'Name_VN_Unicode', 'Product_ID', 'Service_ID', 'Images'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = SoccerLeagueInfo::find();

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
            'ID' => $this->ID,
            'Display_Order' => $this->Display_Order,
            'CategoryID' => $this->CategoryID,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
                ->andFilterWhere(['like', 'Logo', $this->Logo])
                ->andFilterWhere(['like', 'CurrentRound', $this->CurrentRound])
                ->andFilterWhere(['like', 'Code_Param1', $this->Code_Param1])
                ->andFilterWhere(['like', 'Code_Param2', $this->Code_Param2])
                ->andFilterWhere(['like', 'Code_Param3', $this->Code_Param3])
                ->andFilterWhere(['like', 'Code_Param4', $this->Code_Param4])
                ->andFilterWhere(['like', 'Code_Param5', $this->Code_Param5])
                ->andFilterWhere(['like', 'Code_Param6', $this->Code_Param6])
                ->andFilterWhere(['like', 'Name_VN', $this->Name_VN])
                ->andFilterWhere(['like', 'BXH', $this->BXH])
                ->andFilterWhere(['like', 'Name_VN_Unicode', $this->Name_VN_Unicode])
                ->andFilterWhere(['like', 'Product_ID', $this->Product_ID])
                ->andFilterWhere(['like', 'Service_ID', $this->Service_ID])
                ->andFilterWhere(['like', 'Images', $this->Images]);
        $query->orderBy("Display_Order");
        return $dataProvider;
    }

}
