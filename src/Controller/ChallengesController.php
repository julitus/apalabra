<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Challenges Controller
 *
 * @property \App\Model\Table\ChallengesTable $Challenges
 *
 * @method \App\Model\Entity\Challenge[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChallengesController extends AppController
{

    public function isAuthorized($user)
    {
        //debug($slug = $this->request->getParam('pass')); exit();
        $action = $this->request->getParam('action');
        if (in_array($action, ['index', 'add'])) {
            return $user['role'] == 1;
        }
        if (in_array($action, ['edit', 'active', 'delete'])) {
            if ($user['role'] == 1) {
                $idChallenge = $this->request->getParam('pass.0');
                $challenge = $this->Challenges->findById($idChallenge)->first();
                return ($challenge && $challenge->user_id === $user['id']);
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
            'contain' => [],
            'order' => [
                'Challenges.modified' => 'desc'
            ]
        ];

        $search = '';
        $idUserSession = $this->Auth->user('id');

        if (isset($this->request->query['search']) and $this->request->query['search'] != '') {
            $search = $this->request->query['search'];
            $w = '%'.$search.'%';
            $challenges = $this->paginate($this->Challenges->find()
                        ->where(['Challenges.user_id' => $idUserSession, 
                            'OR' => ["Challenges.name LIKE" => $w]])
                    );
        } else {
            $challenges = $this->paginate($this->Challenges->find()
                        ->where(['Challenges.user_id' => $idUserSession]));
        }

        $this->set(compact('challenges', 'search'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $challenge = $this->Challenges->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->getData();
            $data['user_id'] = $this->Auth->user('id');
            $data['nrows'] = count($data['questions']);

            $challenge = $this->Challenges->patchEntity($challenge, $data, ['associated' => [ 'Questions']]);
            if ($this->Challenges->save($challenge)) {
                $this->Flash->success(__('El desafío se guardó con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se guardó el desafío, intentelo nuevamente.'));
        }
        $this->set(compact('challenge'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Challenge id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $challenge = $this->Challenges->get($id, [
            'contain' => ['Questions'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $data = $this->request->getData();
            $data['nrows'] = count($data['questions']);

            $challenge = $this->Challenges->patchEntity($challenge, $data, ['associated' => [ 'Questions']]);
            if ($this->Challenges->save($challenge)) {
                $this->Flash->success(__('El desafío se guardó con éxito.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se guardó el desafío, intentelo nuevamente.'));
        }
        $users = $this->Challenges->Users->find('list', ['limit' => 200]);
        $this->set(compact('challenge', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Challenge id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $challenge = $this->Challenges->get($id);
        if ($this->Challenges->delete($challenge)) {
            $this->Flash->success(__('El desafío fue eliminado.'));
        } else {
            $this->Flash->error(__('No se eliminó el desafío, intentelo nuevamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function active($id = null)
    {
        if ($this->request->is('post')) {
            $challenge = $this->Challenges->get($id);
            $challenge->active = !$challenge->active;
            $this->Challenges->save($challenge);
            if ($challenge->active) {
                $this->Flash->success(__('El desafío fue activado.'));
            } else {
                $this->Flash->success(__('El desafío fue desactivado.'));
            }
        }

        return $this->redirect($this->referer());
    }
}
