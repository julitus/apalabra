<?php
namespace App\Controller;

use Rest\Controller\RestController;
use Cake\Event\Event;
use Cake\Auth\DefaultPasswordHasher;

class RestPlayersController extends RestController
{

	public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');

    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Players');
        $this->Auth->allow();
    }

    public function register()
    {
        if ($this->request->is('post')) {

            $data = $this->request->getData();

            $player = $this->Players->find()->where(['Players.email' => $data['email']])->first();

            if ($player) {
                $err = 'EXISTING_USER';
                $msg = "No se realizó el registro, existe un usuario registrado con este email";
                $this->set(compact('err', 'msg'));
                $this->response->statusCode(400);
            } else {

                $player = $this->Players->newEntity($data);

                if ($this->Players->save($player)) {
                    $this->response->statusCode(200);
                } else {
                    $err = 'NO_SAVE';
                    $msg = "No se realizó el registro, por favor vuelva a intentarlo en unos minutos";
                    $this->set(compact('err', 'msg'));
                    $this->response->statusCode(400);
                }
            }
        }
    }

    public function signin()
    {
    	if ($this->request->is('post')) {

            $data = $this->request->getData();

            $player = $this->Players->find()->where(['Players.email' => $data['email']])->first();

            if($player){

                if ($player->active) {
                    if( (new DefaultPasswordHasher)->check($data['password'], $player->password) ){

                        $token = \Rest\Utility\JwtToken::generate($player);

                        $this->set(compact('player', 'token'));
                        $this->response->statusCode(200);
                    }else {
                        $err = "INVALID_PASSWORD";
                        $msg = "Usuario ó contraseña incorrectas";
                        $this->set(compact('err', 'msg'));
                        $this->response->statusCode(400);
                    }
                } else {
                    $err = "INACTIVE_USER";
                    $msg = "Lo sentimos, se ha desactivado su usuario";
                    $this->set(compact('err', 'msg'));
                    $this->response->statusCode(400);
                }

            } else {
                $err = "INVALID_FIELDS";
                $msg = "Usuario ó contraseña incorrectas";
                $this->set(compact('err', 'msg'));
                $this->response->statusCode(400);
            }

        }
    }

    public function update()
    {
    	if ($this->request->is('post')) {

            $data = $this->request->getData();

            $player = $this->Players->get($this->payload->id);
            $player = $this->Players->patchEntity($player, $data);

            if ($this->Players->save($player)) {
                $this->response->statusCode(200);
            } else {
                $err = 'NO_SAVE';
                $msg = "No se actualizó su información, por favor vuelva a intentarlo en unos minutos";
                $this->set(compact('err', 'msg'));
                $this->response->statusCode(400);
            }
        }
    }

    public function changePass()
    {
    	if ($this->request->is('post')) {

            $data = $this->request->getData();
            $data['password'] = $data['new_password'];

            $player = $this->Players->get($this->payload->id);
            $player = $this->Players->patchEntity($player, $data);

            if ($this->Players->save($player)) {
                $this->response->statusCode(200);
            } else {
                $err = 'NO_SAVE';
                $msg = "No se pudo actualizar su contraseña, por favor vuelva a intentarlo en unos minutos";
                $this->set(compact('err', 'msg'));
                $this->response->statusCode(400);
            }
        }
    }

    public function setConnection()
    {
    	if ($this->request->is('post')) {

    		$this->loadModel('Users');
    		$data = $this->request->getData();

    		$user = $this->Users->find()->where(['Users.code' => $data['code'], 'Users.role' => 1])->first();
    		if ($user) {
    			if ($user->active) {
    				$connection = $this->Players->Connections->find()
										->where(['Connections.user_id' => $user->id, 'Connections.player_id' => $this->payload->id])->first();

					if ($connection) {
						$err = 'CONNECTION_EXIST';
		                $msg = "Ya se ingresó el código";
		                $this->set(compact('err', 'msg'));
		                $this->response->statusCode(400);
					} else {
						$data['user_id'] = $user->id;
						$data['player_id'] = $this->payload->id;

						$connection = $this->Players->Connections->newEntity($data);
						if ($this->Players->Connections->save($connection)) {
			                $this->response->statusCode(200);

			            } else {
			                $err = 'NO_SAVE';
			                $msg = "No se pudo usar el código, por favor vuelva a intentarlo en unos minutos";
			                $this->set(compact('err', 'msg'));
			                $this->response->statusCode(400);
			            }
					}
				} else {
					$err = 'INACTIVE_CREATOR';
	                $msg = "El creador fue inhabilitado, el código no esta en uso";
	                $this->set(compact('err', 'msg'));
	                $this->response->statusCode(400);
				}
			} else {
				$err = 'NO_CREATOR_EXIST';
                $msg = "Código inválido";
                $this->set(compact('err', 'msg'));
                $this->response->statusCode(400);
			}
    	}
    }

    public function getConnections()
    {
        if ($this->request->is('post')) {

            $connections = $this->Players->Connections->find()
                                ->select(['Connections.id', 'Connections.user_id', 'Connections.attemps', 'Connections.active', 'Users.id', 'Users.name', 'Users.email', 'Users.description', 'Users.code'])
                                //->where(['Connections.player_id' => $this->payload->id, 'Connections.active' => true])
                                ->where(['Connections.player_id' => $this->payload->id])
                                ->contain(['Users']);

            $this->set(compact('connections'));
            $this->response->statusCode(200);
        }
    }

}