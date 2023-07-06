<?php

		namespace App\Controllers;
		use App\Models\TransaksiModel;

		class StatusKirimController extends BaseController
		{
			protected $transaksi;

			function __construct()
			{
				helper('form');
				$this->validation = \Config\Services::validation();
				$this->transaksi = new TransaksiModel();
			}

			public function index()
			{
				$data['transaksis'] = $this->transaksi->findAll();
				return view('pages/transaction_view', $data);
			}

			public function edit($id)
			{
				$data = $this->request->getPost();

				if($data>0){
                    $dataForm = ['status' => $this->request->getPost('status')];
					$this->transaksi->update($id, $dataForm);

					return redirect('transaksi')->with('success','Data successfully updated.');
				}else{
					return redirect('transaksi')->with('failed', "Data wasn't successfully updated. ");
				}
				
			}

		}