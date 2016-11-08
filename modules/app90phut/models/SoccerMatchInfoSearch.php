<?php

namespace app\modules\app90phut\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\app90phut\models\SoccerMatchInfo;

/**
 * SoccerMatchInfoSearch represents the model behind the search form about `app\modules\app90phut\models\SoccerMatchInfo`.
 */
class SoccerMatchInfoSearch extends SoccerMatchInfo {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['AwayID', 'HomeID', 'MatchID', 'MatchState', 'MinuteEx', 'MinutePlaying', 'XHAway', 'XHHome', 'LeagueID', 'TTUpdateFinishMatch', 'ExtendAuto'], 'integer'],
            [['AwayName', 'HomeName', 'MatchPeriod', 'Odds', 'Score', 'StartTime', 'AName', 'BName', 'CAName', 'CBName', 'VName'], 'safe'],
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
        $query = SoccerMatchInfo::find();

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
            'AwayID' => $this->AwayID,
            'HomeID' => $this->HomeID,
            'MatchID' => $this->MatchID,
            'MatchState' => $this->MatchState,
            'MinuteEx' => $this->MinuteEx,
            'MinutePlaying' => $this->MinutePlaying,
            'StartTime' => $this->StartTime,
            'XHAway' => $this->XHAway,
            'XHHome' => $this->XHHome,
            'LeagueID' => $this->LeagueID,
            'TTUpdateFinishMatch' => $this->TTUpdateFinishMatch,
            'ExtendAuto' => $this->ExtendAuto,
        ]);

        $query->andFilterWhere(['like', 'AwayName', $this->AwayName])
                ->andFilterWhere(['like', 'HomeName', $this->HomeName])
                ->andFilterWhere(['like', 'MatchPeriod', $this->MatchPeriod])
                ->andFilterWhere(['like', 'Odds', $this->Odds])
                ->andFilterWhere(['like', 'Score', $this->Score])
                ->andFilterWhere(['like', 'AName', $this->AName])
                ->andFilterWhere(['like', 'BName', $this->BName])
                ->andFilterWhere(['like', 'CAName', $this->CAName])
                ->andFilterWhere(['like', 'CBName', $this->CBName])
                ->andFilterWhere(['like', 'VName', $this->VName]);


        return $dataProvider;
    }

}
