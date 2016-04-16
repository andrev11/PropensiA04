<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pembelian;

/**
 * PembelianSearch represents the model behind the search form about `app\models\Pembelian`.
 */
class PembelianSearch extends Pembelian
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idbeli', 'idbayar'], 'integer'],
            [['supplier', 'produk', 'tgl_beli', 'tgl_terima', 'cara_terima', 'cara_bayar', 'status_del'], 'safe'],
            [['harga_total', 'karton', 'kilo'], 'number'],
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
        $query = Pembelian::find();

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
            'idbeli' => $this->idbeli,
            'idbayar' => $this->idbayar,
            'tgl_beli' => $this->tgl_beli,
            'tgl_terima' => $this->tgl_terima,
            'harga_total' => $this->harga_total,
            'karton' => $this->karton,
            'kilo' => $this->kilo,
        ]);

        $query->andFilterWhere(['ilike', 'supplier', $this->supplier])
            ->andFilterWhere(['ilike', 'produk', $this->produk])
            ->andFilterWhere(['ilike', 'cara_terima', $this->cara_terima])
            ->andFilterWhere(['ilike', 'cara_bayar', $this->cara_bayar])
            ->andFilterWhere(['ilike', 'status_del', $this->status_del]);

        return $dataProvider;
    }
}
