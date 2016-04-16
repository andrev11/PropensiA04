<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PembayaranOut;

/**
 * PembelianOutSearch represents the model behind the search form about `app\models\PembayaranOut`.
 */
class PembelianOutSearch extends PembayaranOut
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idbayar'], 'integer'],
            [['supplier', 'tgl_trans', 'tgl_bayar', 'status_bayar'], 'safe'],
            [['jumlahbayar'], 'number'],
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
        $query = PembayaranOut::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idbayar' => $this->idbayar,
            'tgl_trans' => $this->tgl_trans,
            'tgl_bayar' => $this->tgl_bayar,
            'jumlahbayar' => $this->jumlahbayar,
        ]);

        $query->andFilterWhere(['like', 'supplier', $this->supplier])
            ->andFilterWhere(['like', 'status_bayar', $this->status_bayar]);

        return $dataProvider;
    }
}
