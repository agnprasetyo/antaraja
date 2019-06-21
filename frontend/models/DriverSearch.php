<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Driver;

/**
 * DriverSearch represents the model behind the search form of `common\models\Driver`.
 */
class DriverSearch extends Driver
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'no_sim', 'no_ktp', 'usia', 'no_rek_mandiri'], 'integer'],
            [['tanggal', 'nama', 'email', 'pendidikan', 'jenis_kelamin', 'status', 'alamat_tinggal', 'alamat_ktp', 'merk_motor', 'pekerjaan', 'nopol_kendaraan', 'files', 'ojol', 'berkas'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $q = null)
    {
        $query = Driver::find()
        // ->where(['like', 'no_ktp', $q])
        // ->orWhere(['like', 'no_sim', $q])
        ->where(['no_ktp' => $q])
        ->orWhere(['no_sim' => $q])
        ->andWhere(['!=', 'berkas', Driver::BERKAS_DELETED]);

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
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'no_sim' => $this->no_sim,
            'no_ktp' => $this->no_ktp,
            'usia' => $this->usia,
            'no_rek_mandiri' => $this->no_rek_mandiri,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'pendidikan', $this->pendidikan])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'alamat_tinggal', $this->alamat_tinggal])
            ->andFilterWhere(['like', 'alamat_ktp', $this->alamat_ktp])
            ->andFilterWhere(['like', 'merk_motor', $this->merk_motor])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'nopol_kendaraan', $this->nopol_kendaraan])
            ->andFilterWhere(['like', 'files', $this->files])
            ->andFilterWhere(['like', 'ojol', $this->ojol])
            ->andFilterWhere(['like', 'berkas', $this->berkas]);

        return $dataProvider;
    }
}
