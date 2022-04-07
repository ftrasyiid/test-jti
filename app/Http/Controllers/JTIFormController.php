<?php

namespace App\Http\Controllers;

use App\Models\JTIForm;
use Illuminate\Http\Request;

class JTIFormController extends Controller
{
    private $providers = [
        'Telkomsel', 
        'Indosat Ooreodo', 
        'XL Axiata', 
        'Smartfren', 
        'Lainnya', 
    ];

    /**
     * Instansiai JTIFormController.
     *
     * @param JTIForm $JTIForm inject JTIForm model
     */
    public function __construct(JTIForm $JTIForm)
    {
        $this->jti_form = $JTIForm;
    }

    /**
     * Menampilkan halaman form output.
     * Berisi semua data JTIForm yang ada di database.
     *
     * @return Illuminate\Support\Facades\View
     */
    public function index()
    {
        $jti_outputs = $this->jti_form->getJTIFormsOddEven();
        return view('jti.output', ['jti_outputs' => $jti_outputs]);
    }

    /**
     * Menampilkan halaman form input.
     *
     * @return Illuminate\Support\Facades\View
     */
    public function create()
    {
        return view('jti.input', ['providers' => $this->providers]);
    }

    /**
     * Menampilkan halaman edit
     *
     * @param integer $id
     * @return Illuminate\Support\Facades\View
     */
    public function edit(int $id)
    {
        $jti_form = $this->jti_form->getJTIForm($id);
        return view('jti.edit', ['jti_form' => $jti_form]);
    }
}
