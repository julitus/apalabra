<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Connections Controller
 *
 * @property \App\Model\Table\ConnectionsTable $Connections
 *
 * @method \App\Model\Entity\Connection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConnectionsController extends AppController
{

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'history'])) {
            return $user['role'] == 1;
        }
        if (in_array($action, ['active'])) {
            if ($user['role'] == 1) {
                $idConnection = $this->request->getParam('pass.0');
                $connection = $this->Connections->findById($idConnection)->first();
                return ($connection && $connection->user_id === $user['id']);
            }
        }
        return false;
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
            'contain' => ['Players'],
            'sortWhitelist' => [
                'Players.email',
                'Players.firstname',
                'Players.lastname',
                'attemps',
                'active',
                'created',
                'modified'
            ],
            'order' => [
                'Connections.modified' => 'desc'
            ]
        ];

        $search = '';

        if (isset($this->request->query['search']) and $this->request->query['search'] != '') {
            $search = $this->request->query['search'];
            $w = '%'.$search.'%';
            $connections = $this->paginate($this->Connections->find()
                        ->where(['Connections.user_id' => $this->Auth->user('id'), 'OR' => ["Players.email LIKE" => $w, "CONCAT(firstname, ' ', lastname) LIKE" => $w]])
                    );
        } else {
            $connections = $this->paginate($this->Connections->find()
                        ->where(['Connections.user_id' => $this->Auth->user('id')])
                    );
        }

        $this->set(compact('connections', 'search'));
    }

    public function active($id = null)
    {
        if ($this->request->is('post')) {
            $connection = $this->Connections->get($id);
            $connection->active = !$connection->active;
            $this->Connections->save($connection);
            if ($connection->active) {
                $this->Flash->success(__('El jugador fue activado para participar en los desafíos.'));
            } else {
                $this->Flash->success(__('El jugador fue desactivado para participar en los desafíos.'));
            }
        }

        return $this->redirect($this->referer());
    }

    public function history($id = null) 
    {
        
    }

}
