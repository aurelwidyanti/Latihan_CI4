<?php

		namespace App\Controllers;

		use App\Models\userModel;
		use CodeIgniter\Email\Email;

		class AuthController extends BaseController
		{
			protected $email;
		    protected $user;

		    function __construct()
		    {
		        helper('form');
				helper('text');
		        $this->user = new userModel();

				$this->email = \Config\Services::email();

				$this->email->initialize([
					'protocol' => 'smtp',
					'SMTPHost' => 'smtp.gmail.com',
                    'SMTPPort' => '587',
                    'SMTPUser' => 'xiaoracing@gmail.com',
                    'SMTPPass' => 'hpligulhudsvenvc',
                    'mailType' => 'html',
                    'charset' => 'utf-8',
                    'newline' => "\r\n"
				]);
		    }

		    public function login()
		    {
		        if ($this->request->getPost()) {
		            $username = $this->request->getVar('username');
		            $password = $this->request->getVar('password');

		            $dataUser = $this->user->where(['username' => $username])->first();

					if ($dataUser) {
						if ($dataUser['is_active']==1) {
							if (md5($password) == $dataUser['password']) {
								session()->set([
									'username' => $dataUser['username'],
									'role' => $dataUser['role'],
									'isLoggedIn' => TRUE
								]);
	
								return redirect()->to(base_url('/'));
							} else {
								session()->setFlashdata('failed', 'Wrong username/password.');
								return redirect()->back();
							}
						} else {
							session()->setFlashdata('failed', "User hasn't been verified.");
							return redirect()->to('/verify');
						}	
					} else {
						session()->setFlashdata('failed', 'Username not found.');
						return redirect()->back();
					}	

		        } else {
		            return view('login_view');
		        }
		    }

			public function register()
			{
				if($this->request->getPost()) {
					$username = $this->request->getVar('username');
					$password = $this->request->getVar('password');
					$email = $this->request->getVar('email');

					$existingUser = $this->user->where(['username' => $username])->first();
					$existingEmail = $this->user->where(['email' => $email])->first();

					if ($existingUser) {
						session()->setFlashdata('failed', 'Username has been used.');
						return redirect()->back();
					}

					if ($existingEmail) {
						session()->setFlashdata('failed', 'Email already used.');
						return redirect()->back();
					}
					
					$validationCode = random_string('numeric', 4);
					$this->sendValidationEmail($email,$validationCode);
					$hashPw = md5($password);
					$this->user->insert([
                        'username' => $username,
                        'password' => $hashPw,
						'email' => $email,
                        'role' => 'user',
						'code' => $validationCode
                    ]);

					session()->setFlashdata('failed', 'Please verify your account using the code sent to your email.');
                    session()->setFlashdata('success', 'Registration successful');
                    return redirect()->to(base_url('/verify'));
				} else {
					return view('register_view');
				}
			}

			public function sendValidationEmail($email,$validationCode)
			{
				$this->email->setFrom('xiaoracing@gmail.com', 'Xiaomay');
				$this->email->setTo($email);
				$this->email->setSubject('Account Validation');
				$this->email->setMessage('Please use the following code to validate your account : <b>' .$validationCode.'</b>');

				if ($this->email->send()) {
					echo 'Email sent successfully.';
				} else {
					echo $this->email->printDebugger();
				}
			}

			public function verifyCode()
			{
				if ($this->request->getPost()) {
					$code = implode('', $this->request->getPost('code'));

					$user = $this->user->where(['code' => $code])->first();

					if ($user) {
						$this->user->update($user['id'], ['is_active' => 1]);

						session()->setFlashdata('success', 'Account validation successful, you can now log in.');
						return redirect()->to(base_url('/login'));
					} else {
						session()->setFlashdata('failed', 'Invalid validation code.');
						return redirect()->back();
					}
				} else {
					return view('verify_view');
				}
			}

		    public function logout()
		    {
		        session()->destroy();
		        return redirect()->to('login');
		    }
		}