<?php
namespace backend\models;

use yii\base\Model;
use common\models\Driver;
use common\models\NoHp;
use common\models\MerkHp;

/**
 * DriverForm form
 */
class DriverForm extends Model
{
    public $_nama;
    public $_email;
    public $_no_rek_mandiri;
    public $_alamat_ktp;
    public $_alamat_tinggal;
    public $_no_ktp;
    public $_no_sim;
    public $_merk_motor;
    public $_nomer1;
    public $_merk;
    public $_nopol_kendaraan;
    public $_nomer2;
    public $_type;
    public $_ojol;
    public $_usia;
    public $_pekerjaan;
    public $_pendidikan;
    public $_jenis_kelamin;
    public $_status;
    public $_files;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_nama', '_email', '_no_sim', '_no_ktp', '_pendidikan', '_jenis_kelamin', '_status', '_usia', '_alamat_tinggal', '_alamat_ktp', '_merk_motor', '_pekerjaan', '_nopol_kendaraan', '_ojol'], 'required'],
            [['_no_sim', '_no_ktp', '_usia', '_no_rek_mandiri'], 'integer'],
            [['_no_sim', '_no_ktp'], 'unique'],
            [['_nama', '_merk_motor', '_pekerjaan'], 'string', 'max' => 20],
            [['_email'], 'string', 'max' => 255],
            [['_pendidikan', '_jenis_kelamin', '_status', '_ojol'], 'string', 'max' => 32],
            [['_alamat_tinggal', '_alamat_ktp'], 'string', 'max' => 30],
            [['_nopol_kendaraan'], 'string', 'max' => 10],
            [['_files'], 'file', 'extensions' => 'pdf'],

            [['_nomer1'], 'required'],
            [['_nomer1', '_nomer2'], 'integer'],
            [['_nomer1', '_nomer2'], 'string', 'max' => 20],

            [['_merk', 'type'], 'required'],
            [['_merk', 'type'], 'string', 'max' => 20],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function updateRecord($id)
    {
        // if (!$this->validate()) {
        //     return null;
        // }
        
        $model = Driver::findOne($id);

        if (!empty($this->_files)) {
            // @unlink
            $model->files = $this->_no_ktp . '.' . $this->_files->extension;
        }

        $model->nama = $this->_nama;
        $model->email = $this->_email;
        $model->no_sim = $this->_no_sim;
        $model->no_ktp = $this->_no_ktp;
        $model->pendidikan = $this->_pendidikan;
        $model->jenis_kelamin = $this->_jenis_kelamin;
        $model->status = $this->_status;
        $model->usia = $this->_usia;
        $model->no_rek_mandiri = $this->_no_rek_mandiri;
        $model->alamat_tinggal = $this->_alamat_tinggal;
        $model->alamat_ktp = $this->_alamat_ktp;
        $model->merk_motor = $this->_merk_motor;
        $model->pekerjaan = $this->_pekerjaan;
        $model->nopol_kendaraan = $this->_nopol_kendaraan;
        $model->ojol = $this->_ojol;

        $modelNo1 = $model['noHps'][0];
        $modelNo2 = $model['noHps'][1];
        $modelMerk = $model['merkHps'][0];
        $modelNo1->nomer = $this->_nomer1;
        $modelNo2->nomer = $this->_nomer2;

        $modelMerk->merk = $this->_merk;
        $modelMerk->type = $this->_type;

        // echo "<pre>";print_r($modelNo1);exit;

        $flag = 0;
        if ($model->save(false)) {
            $flag = 1;
            if ($modelNo1->save(false) && $modelNo2->save(false)) {
                $flag = 2;
                if ($modelMerk->save(false)) {
                    $flag = 3;
                }
            }
        }

        return $flag;
    }
}
