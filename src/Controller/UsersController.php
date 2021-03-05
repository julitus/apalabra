<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout']);
    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'add', 'edit', 'active', 'delete', 'updatePassword'])) {
            return $user['role'] == 0;
        }
        if (in_array($action, ['changePassword', 'profile'])) {
            return true;
        }
        return false;
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if ($user['active']) {
                    $this->Auth->setUser($user);
                    $this->Flash->success('Bienvenido ' . $user['name'] . '.');
                    if ($user['role'] == 0) {
                        return $this->redirect(['action' => 'index']);
                    } else if ($user['role'] == 1) {
                        return $this->redirect(['controller' => 'Challenges', 'action' => 'index']);
                    } else {
                        return $this->redirect($this->Auth->redirectUrl());
                    }
                } else {
                    $this->Flash->error('Usuario desactivado.');    
                }
            } else {
                $this->Flash->error('Credenciales incorrectas.');
            }
        }
        $this->viewBuilder()->setLayout('initial');
    }

    public function logout()
    {
        //$this->Flash->success('Nos vemos!!!.');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'limit' => 20,
            'contain' => [],
            'order' => [
                'Users.modified' => 'desc'
            ]
        ];

        $search = '';

        if (isset($this->request->query['search']) and $this->request->query['search'] != '') {
            $search = $this->request->query['search'];
            $w = '%'.$search.'%';
            $users = $this->paginate($this->Users->find()
                        ->where(['Users.role' => 1, 
                            'OR' => ["Users.username LIKE" => $w, 'Users.name LIKE' => $w, 'Users.code LIKE' => $w, 'Users.email LIKE' => $w]])
                    );
        } else {
            $users = $this->paginate($this->Users->find()
                        ->where(['Users.role' => 1]));
        }

        $this->set(compact('users', 'search'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->role = 1;

            do {
                $user->code = $this->generateCode(6);
                $checkUserCode = $this->Users->find()->where(['Users.code' => $user->code])->first();
            } while($checkUserCode);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('El creador se guardó con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se guardó el creador, intentelo nuevamente.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El creador fue editado con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se editó el creador, intentelo nuevamente.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);

        // Antes de eliminar revisar los registros enlazados

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('El creador fue eliminado.'));
        } else {
            $this->Flash->error(__('No se eliminó el creador, intentelo nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function active($id = null)
    {
        if ($this->request->is('post')) {
            $user = $this->Users->get($id);
            $user->active = !$user->active;
            $this->Users->save($user);
            if ($user->active) {
                $this->Flash->success(__('El creador fue activado.'));
            } else {
                $this->Flash->success(__('El creador fue desactivado.'));
            }
        }

        return $this->redirect($this->referer());
    }

    public function profile()
    {
        $idUserSession = $this->Auth->user('id');
        $user = $this->Users->get($idUserSession, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['name'] = $data['new_name'];
            $data['email'] = $data['new_email'];
            $data['phone'] = $data['new_phone'];
            $data['description'] = $data['new_description'];

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {

                $data = $user->toArray();
                unset($data['password']);
                $this->Auth->setUser($data);
                
                $this->Flash->success(__('Su perfil fue actualizado con éxito.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('No se actualizó su perfil, intentelo nuevamente.'));
        }
        $this->set(compact('user'));
    }

    public function changePassword()
    {
        $idUserSession = $this->Auth->user('id');
        $user = $this->Users->get($idUserSession, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['password'] = $data['new_password'];

            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Su contraseña se actualizó con éxito.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('No se actualizó su contraseña, intentelo nuevamente.'));
        }
        $this->set(compact('user'));
    }

    public function updatePassword($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('La contraseña se actualizó con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se actualizó la contraseña, intentelo nuevamente.'));
        }
        $this->set(compact('user'));
    }

    public function generateCode($size)
    {   
        $chars = '0123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $key = '';
        for ($i = 0; $i < $size; $i++) {
            $key .= $chars[mt_rand(0, 34)];
        }
        return $key;
    }
}
