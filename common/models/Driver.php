<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "driver".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $nama
 * @property string $email
 * @property string $no_sim
 * @property string $no_ktp
 * @property string $pendidikan
 * @property string $jenis_kelamin
 * @property string $status
 * @property int $usia
 * @property int $no_rek_mandiri
 * @property string $alamat_tinggal
 * @property string $alamat_ktp
 * @property string $merk_motor
 * @property string $pekerjaan
 * @property string $nopol_kendaraan
 * @property string $ojol
 * @property string $flag
 *
 * @property MerkHp[] $merkHps
 * @property NoHp[] $noHps
 */
class Driver extends \yii\db\ActiveRecord
{
    const PENDIDIKAN_NONE = 'Tidak Sekolah';
    const PENDIDIKAN_SD = 'SD';
    const PENDIDIKAN_SMP = 'SMP';
    const PENDIDIKAN_SMA = 'SMA';
    const PENDIDIKAN_S1 = 'STRATA 1';

    const KELAMIN_LK = 'LAKI - LAKI';
    const KELAMIN_PR = 'PEREMPUAN';

    const STATUS_MENIKAH = 'MENIKAH';
    const STATUS_BELUM = 'BELUM MENIKAH';

    const OJOL_YA = 'YA';
    const OJOL_TIDAK = 'TIDAK';

    const FLAG_PENDING  = 'Pending';
    const FLAG_DITERIMA = 'Diterima';
    const FLAG_DITOLAK  = 'Ditolak';
    const FLAG_DELETED  = 'Dihapus';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%driver}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['flag', 'default', 'value' => self::FLAG_PENDING],
            [['nama', 'email', 'no_sim', 'no_ktp', 'pendidikan', 'jenis_kelamin', 'status', 'usia', 'alamat_tinggal', 'alamat_ktp', 'merk_motor', 'pekerjaan', 'nopol_kendaraan', 'ojol'], 'required'],
            [['no_sim', 'no_ktp', 'usia', 'no_rek_mandiri'], 'integer'],
            [['no_sim', 'no_ktp'], 'unique'],
            [['nama', 'merk_motor', 'pekerjaan'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 255],
            [['pendidikan', 'jenis_kelamin', 'status', 'ojol'], 'string', 'max' => 32],
            [['alamat_tinggal', 'alamat_ktp'], 'string', 'max' => 30],
            [['nopol_kendaraan'], 'string', 'max' => 10],
            [['files'], 'file', 'extensions' => 'pdf'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal Input',
            'nama' => 'Nama Lengkap',
            'email' => 'Email',
            'no_sim' => 'Nomor SIM',
            'no_ktp' => 'Nomor KTP',
            'pendidikan' => 'Pendidikan',
            'jenis_kelamin' => 'Jenis Kelamin',
            'status' => 'Status',
            'usia' => 'Usia',
            'no_rek_mandiri' => 'Nomor Rekening Mandiri',
            'alamat_tinggal' => 'Alamat Tinggal Sekarang',
            'alamat_ktp' => 'Alamat Tinggal Sesuai KTP',
            'merk_motor' => 'Merk Kendaraan',
            'pekerjaan' => 'Pekerjaan',
            'nopol_kendaraan' => 'Plat Nomor Kendaraan',
            'ojol' => 'Ikut Ojek Online',
            'flag' => 'Flag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMerkHps()
    {
        return $this->hasMany(MerkHp::className(), ['id_driver' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoHps()
    {
        return $this->hasMany(NoHp::className(), ['id_driver' => 'id']);
    }

    /**
     *
     */
    public function listBerkas()
    {
        $flag = [
            self::FLAG_PENDING  => self::FLAG_PENDING,
            self::FLAG_DITERIMA => self::FLAG_DITERIMA,
            self::FLAG_DITOLAK  => self::FLAG_DITOLAK,
        ];

        return $flag;
    }

    /**
     *
     */
    public function listPendidikan()
    {
        $pendidikan = [
            self::PENDIDIKAN_NONE => self::PENDIDIKAN_NONE,
            self::PENDIDIKAN_SD => self::PENDIDIKAN_SD,
            self::PENDIDIKAN_SMP => self::PENDIDIKAN_SMP,
            self::PENDIDIKAN_SMA => self::PENDIDIKAN_SMA,
            self::PENDIDIKAN_S1 => self::PENDIDIKAN_S1,
        ];

        return $pendidikan;
    }

    /**
     *
     */
    public function listJenisKelamin()
    {
        $jenisKelamin = [
            self::KELAMIN_LK => self::KELAMIN_LK,
            self::KELAMIN_PR => self::KELAMIN_PR,
        ];

        return $jenisKelamin;
    }

    /**
     *
     */
    public function listStatus()
    {
        $status = [
            self::STATUS_MENIKAH => self::STATUS_MENIKAH,
            self::STATUS_BELUM => self::STATUS_BELUM,
        ];

        return $status;
    }

    /**
     *
     */
    public function listOjol()
    {
        $ojol= [
            self::OJOL_YA => self::OJOL_YA,
            self::OJOL_TIDAK => self::OJOL_TIDAK,
        ];

        return $ojol;
    }

    /**
     *
     */
    public function isTerima($id)
    {
        $model = static::findOne($id);

        return $model ? $model->flag == self::FLAG_DITERIMA : false;
    }

    /**
     *
     */
    public function isTolak($id)
    {
        $model = static::findOne($id);

        return $model ? $model->flag == self::FLAG_DITOLAK : false;
    }

    /**
     *
     */
    public function hasFiles($id)
    {
        $model = static::findOne($id);

        return $model ? (bool) $model->files : false;
    }
}
