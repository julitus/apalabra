<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Players Controller
 *
 * @property \App\Model\Table\PlayersTable $Players
 *
 * @method \App\Model\Entity\Player[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlayersController extends AppController
{

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'edit', 'active', 'delete', 'updatePassword'])) {
            return $user['role'] == 0;
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
            'contain' => [],
            'order' => [
                'Players.modified' => 'desc'
            ]
        ];

        $search = '';

        if (isset($this->request->query['search']) and $this->request->query['search'] != '') {
            $search = $this->request->query['search'];
            $w = '%'.$search.'%';
            $players = $this->paginate($this->Players->find()
                        ->where(['OR' => ["Players.email LIKE" => $w, "CONCAT(firstname, ' ', lastname) LIKE" => $w]])
                    );
        } else {
            $players = $this->paginate($this->Players->find());
        }

        $this->set(compact('players', 'search'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $player = $this->Players->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__('El jugador fue editado con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se editó el jugador, intentelo nuevamente.'));
        }
        $this->set(compact('player'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $player = $this->Players->get($id);
        if ($this->Players->delete($player)) {
            $this->Flash->success(__('El jugador fue eliminado.'));
        } else {
            $this->Flash->error(__('No se eliminó el jjugador, intentelo nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function active($id = null)
    {
        if ($this->request->is('post')) {
            $player = $this->Players->get($id);
            $player->active = !$player->active;
            $this->Players->save($player);
            if ($player->active) {
                $this->Flash->success(__('El jugador fue activado.'));
            } else {
                $this->Flash->success(__('El jugador fue desactivado.'));
            }
        }

        return $this->redirect($this->referer());
    }

    public function updatePassword($id = null)
    {
        $player = $this->Players->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__('La contraseña se actualizó con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se actualizó la contraseña, intentelo nuevamente.'));
        }
        $this->set(compact('player'));
    }
}
