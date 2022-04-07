<?php

namespace App\Http\Controllers;

use App\Models\JTIForm;
use Illuminate\Http\Request;

class JTIFormAPIController extends Controller
{
    private $jti_form;
    private $providers = [
        'Telkomsel', 
        'Indosat Ooreodo', 
        'XL Axiata', 
        'Smartfren', 
        'Lainnya', 
    ];

    /**
     * Membuat nomor handphone secara random.
     *
     * @param string $start prefix nomor handphone.
     * @param integer $length panjang nomor handphone setelah prefix.
     * @return string
     */
    private function randomPhoneNumber(string $start = '08', int $length = 10) {
        $phoneNumber = $start;
        for ($i = 0; $i < $length; ++$i) {
            $phoneNumber .= mt_rand(0, 9);
        }
        return $phoneNumber;
    }

    /**
     * Memilih provider secara random.
     *
     * @return string
     */
    private function randomProvider(){
        $providerCount = count($this->providers) -1;
        return $this->providers[mt_rand(0, $providerCount)];
    }

    /**
     * Membuat n data form input. 
     * n Nomor Handphone dan n Provider.
     *
     * @param integer $count jumlah data yang dibuat.
     * @return array
     */
    private function generateJITForm(int $count = 25)
    {
        $jti_forms = array();
        for($i = 0; $i < $count; $i++){
            array_push($jti_forms, [
                'phone_number' => $this->randomPhoneNumber(),
                'provider' => $this->randomProvider()
            ]);
        }
        return $jti_forms;
    }

    /**
     * Instansiai JTIFormAPIController.
     *
     * @param JTIForm $JTIForm inject JTIForm model
     */
    public function __construct(JTIForm $JTIForm)
    {
        $this->jti_form = $JTIForm;
    }

    /**
     * Mengambil semua data JTIForm dari database.
     *
     * @return array
     */
    public function index()
    {
        return $this->jti_form->getJTIFormsOddEven();
    }

    /**
     * Mengambil data JTIForm dari database yang memiliki id tertentu.
     *
     * @param integer $id
     * @return \App\Models\JTIForm
     */
    public function show(int $id){
        $outputForm = $this->jti_form->getJTIForm($id);
        return $outputForm;
    }

    /**
     * Menyimpan 1 data JTIForm ke database. 
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\JTIForm
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'phone_number' => ['required', 'string'],
            'provider'  => ['required', 'string']
        ]);
        $inputForm = $this->jti_form->setJTIForm( $validatedData['phone_number'], $validatedData['provider'] );
        return $inputForm;
    }

    /**
     * Menyimpan 25 data JTIForm ke database.
     * 
     * @return array
     */
    public function auto()
    {
        $jti_forms = $this->generateJITForm();
        return $this->jti_form->setJTIForms($jti_forms);
    }

    /**
     * Memperbaharui data JTIForm di database yang memiliki id tertentu.
     *
     * @param Request $request
     * @param integer $id
     * @return void
     */
    public function update(Request $request, int $id){
        $validatedData = $this->validate($request, [
            'phone_number' => ['required', 'string'],
            'provider'  => ['required', 'string']
        ]);

        $updatedForm = $this->jti_form->updateJTIForm($id, $validatedData['phone_number'], $validatedData['provider']);
        return $updatedForm;
    }

    /**
     * Menghapus data JTIForm di database yang memiliki id tertentu.
     *
     * @param integer $id
     * @return mixed
     */
    public function delete(int $id){
        return $this->jti_form->deleteJTIForm($id);
    }
}
