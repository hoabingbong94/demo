<?php

namespace app\modules\app90phut\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\app90phut\models\News;

/**
 * NewsSearch represents the model behind the search form about `app\modules\app90phut\models\News`.
 */
class NewsSearch extends News {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ID', 'NewsID', 'CategoryID', 'Category', 'LikeCount', 'ViewCount', 'PostCount', 'ExtendIsPublic', 'ExtendUserCreate', 'ExtendHot', 'ExtendGet', 'ExtendVip', 'ExtendUserUpdate', 'ExtendTop', 'ExtendUp', 'ExtendMatchID', 'ExtendHighLight'], 'integer'],
            [['Title', 'Summary', 'Thumbnails', 'ThumbnailsPc', 'CoverImage', 'Contents', 'ExtendContentMobile', 'Keyword', 'Author', 'Source', 'ReleaseDate', 'ThumbnailsDesc', 'AudioPath', 'VideoPath', 'ExtendUpdateDate', 'ExtendUpdateTime'], 'safe'],
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
        $query = News::find();

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
            'NewsID' => $this->NewsID,
            'CategoryID' => $this->CategoryID,
            'Category' => $this->Category,
            'ReleaseDate' => $this->ReleaseDate,
            'LikeCount' => $this->LikeCount,
            'ViewCount' => $this->ViewCount,
            'PostCount' => $this->PostCount,
            'ExtendIsPublic' => $this->ExtendIsPublic,
            'ExtendUserCreate' => $this->ExtendUserCreate,
            'ExtendUpdateDate' => $this->ExtendUpdateDate,
            'ExtendUpdateTime' => $this->ExtendUpdateTime,
            'ExtendHot' => $this->ExtendHot,
            'ExtendGet' => $this->ExtendGet,
            'ExtendVip' => $this->ExtendVip,
            'ExtendUserUpdate' => $this->ExtendUserUpdate,
            'ExtendTop' => $this->ExtendTop,
            'ExtendUp' => $this->ExtendUp,
            'ExtendMatchID' => $this->ExtendMatchID,
            'ExtendHighLight' => $this->ExtendHighLight,
        ]);

        $query->andFilterWhere(['like', 'Title', $this->Title])
                ->andFilterWhere(['like', 'Summary', $this->Summary])
                ->andFilterWhere(['like', 'Thumbnails', $this->Thumbnails])
                ->andFilterWhere(['like', 'ThumbnailsPc', $this->ThumbnailsPc])
                ->andFilterWhere(['like', 'CoverImage', $this->CoverImage])
                ->andFilterWhere(['like', 'Contents', $this->Contents])
                ->andFilterWhere(['like', 'ExtendContentMobile', $this->ExtendContentMobile])
                ->andFilterWhere(['like', 'Keyword', $this->Keyword])
                ->andFilterWhere(['like', 'Author', $this->Author])
                ->andFilterWhere(['like', 'Source', $this->Source])
                ->andFilterWhere(['like', 'ThumbnailsDesc', $this->ThumbnailsDesc])
                ->andFilterWhere(['like', 'AudioPath', $this->AudioPath])
                ->andFilterWhere(['like', 'VideoPath', $this->VideoPath]);

        return $dataProvider;
    }

}
