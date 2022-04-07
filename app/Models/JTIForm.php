<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JTIForm extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'phone_number',
        'provider'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'phone_number' => 'encrypted',
        'provider' => 'encrypted'
    ];

    public $timestamps = false;

    /**
     * Mengambil semua data JTIForm dari database.
     *
     * @return Collection
     */
    public function getJTIForms()
    {
        return $this->all();
    }

    /**
     * Mengambil data JTIForm dari database yang memiliki id tertentu.
     *
     * @param integer $id
     * @return mixed
     */
    public function getJTIForm( int $id )
    {
        return $this->findOrFail( $id );
    }

    /**
     * Menyimpan 1 data JTIForm ke database.
     *
     * @param string $phoneNumber
     * @param string $provider
     * @return JTIForm
     */
    public function setJTIForm( string $phoneNumber, string $provider )
    {
        $this->phone_number = $phoneNumber;
        $this->provider = $provider;
        $this->save();

        return $this;
    }

    /**
     * Menyimpan banyak data JTIForm sekaligus.
     *
     * @param array $jtiForms 
     * @return array
     */
    public function setJTIForms( array $jtiForms )
    {
        $setJTIForms= array();
        foreach( $jtiForms as $jtiForm ){
            $insertedJTIForm = self::create( $jtiForm );
            array_push( $setJTIForms, $insertedJTIForm );
        }
        return $setJTIForms;
    }

    /**
     * Memperbaharui data JTIForm di database yang memiliki id tertentu.
     *
     * @param integer $id
     * @param string $phoneNumber
     * @param string $provider
     * @return JTIForm
     */
    public function updateJTIForm( int $id, string $phoneNumber, string $provider )
    {
        $jtiForm = $this->find( $id );
        $jtiForm->phone_number = $phoneNumber;
        $jtiForm->provider = $provider;
        $jtiForm->save();

        return $jtiForm;
    }

    /**
     * Menghapus data JTIForm di database yang memiliki id tertentu
     *
     * @param integer $id
     * @return mixed
     */
    public function deleteJTIForm( int $id )
    {
        return $this->destroy($id);
    }

    /**
     * Menyaring data JTIForm yang memiliki nomor handphone Ganjil atau tidakk habis dibagi 2.
     *
     * @param Collection $jtiForms
     * @return Collection
     */
    public function getJTIFormsOddNumber(Collection $jtiForms)
    {
        return $jtiForms->filter(function ($jtiForm) {
            return $jtiForm['phone_number'] % 2 == 1;
        });
    }

    /**
     * Menyaring data JTIForm yang memiliki nomor handphone Genap atau habis dibagi 2.
     *
     * @param Collection $jtiForms
     * @return Collection
     */
    public function getJTIFormsEvenNumber(Collection $jtiForms)
    {
        return $jtiForms->filter(function ($jtiForm) {
            return $jtiForm['phone_number'] % 2 == 0;
        });
    }

    /**
     * Menyatukan data JTIForm dengan nomor handphone genap, ganjil dan semuannya.
     *
     * @return array
     */
    public function getJTIFormsOddEven()
    {
        $jtiForms = $this->getJTIForms();
        $jtiFormsOddNumber = $this->getJTIFormsOddNumber( $jtiForms );
        $jtiFormsEvenNumber= $this->getJTIFormsEvenNumber( $jtiForms );
        return [
            'all' => $jtiForms->toArray(),
            'odd' => $jtiFormsOddNumber->toArray(),
            'even'=> $jtiFormsEvenNumber->toArray()
        ];
    }
}
