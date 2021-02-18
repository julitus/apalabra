<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Records Controller
 *
 * @property \App\Model\Table\RecordsTable $Records
 *
 * @method \App\Model\Entity\Record[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RecordsController extends AppController
{

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['history', 'historyPlayer', 'historyChallenge', 'historyResult'])) {
            return $user['role'] == 1;
        }
        return false;
    }

    /**
     * History method
     *
     * @return \Cake\Http\Response|null
     */
    public function history()
    {
        $this->paginate = [
            'limit' => 20,
            'contain' => ['Players', 'Challenges'],
            'sortWhitelist' => [
                'Players.firstname',
                'Challenges.name',
                'Records.created'
            ],
            'order' => [
                'Records.created' => 'desc'
            ]
        ];

        $search = '';

        if (isset($this->request->query['search']) and $this->request->query['search'] != '') {
            $search = $this->request->query['search'];
            $w = '%'.$search.'%';
            $records = $this->paginate($this->Records->find()
                        ->where(['Records.user_id' => $this->Auth->user('id'), 'OR' => ['Challenges.name LIKE' => $w, "Players.email LIKE" => $w, "CONCAT(firstname, ' ', lastname) LIKE" => $w]])
                    );
        } else {
            $records = $this->paginate($this->Records->find()
                        ->where(['Records.user_id' => $this->Auth->user('id')])
                    );
        }

        $this->set(compact('records', 'search'));
    }

    public function historyPlayer($idPlayer = null)
    {
        $this->paginate = [
            'limit' => 20,
            'contain' => ['Challenges'],
            'sortWhitelist' => [
                'Challenges.name',
                'Records.created'
            ],
            'order' => [
                'Records.created' => 'desc'
            ]
        ];

        $search = '';

        if (isset($this->request->query['search']) and $this->request->query['search'] != '') {
            $search = $this->request->query['search'];
            $w = '%'.$search.'%';
            $records = $this->paginate($this->Records->find()
                        ->where(['Records.user_id' => $this->Auth->user('id'), 'Records.player_id' => $idPlayer, 'OR' => ['Challenges.name LIKE' => $w]])
                    );
        } else {
            $records = $this->paginate($this->Records->find()
                        ->where(['Records.user_id' => $this->Auth->user('id'), 'Records.player_id' => $idPlayer])
                    );
        }

        $player = $this->Records->Players->get($idPlayer);
        $this->set(compact('records', 'player', 'search'));
    }

    public function historyChallenge($idChallenge = null)
    {
        $this->paginate = [
            'limit' => 20,
            'contain' => ['Players'],
            'sortWhitelist' => [
                'Players.firstname',
                'Records.created'
            ],
            'order' => [
                'Records.created' => 'desc'
            ]
        ];

        $search = '';

        if (isset($this->request->query['search']) and $this->request->query['search'] != '') {
            $search = $this->request->query['search'];
            $w = '%'.$search.'%';
            $records = $this->paginate($this->Records->find()
                        ->where(['Records.user_id' => $this->Auth->user('id'), 'Records.challenge_id' => $idChallenge, 'OR' => ["Players.email LIKE" => $w, "CONCAT(firstname, ' ', lastname) LIKE" => $w]])
                    );
        } else {
            $records = $this->paginate($this->Records->find()
                        ->where(['Records.user_id' => $this->Auth->user('id'), 'Records.challenge_id' => $idChallenge])
                    );
        }

        $challenge = $this->Records->Challenges->get($idChallenge);
        $this->set(compact('records', 'challenge', 'search'));
    }

    public function historyResult($idResult = null)
    {
        $this->paginate = [
            'limit' => 20,
            'contain' => [],
            'order' => [
                'Records.created' => 'desc'
            ]
        ];

        $search = '';

        if (isset($this->request->query['search']) and $this->request->query['search'] != '') {
            $search = $this->request->query['search'];
            $w = '%'.$search.'%';
            $records = $this->paginate($this->Records->find()
                        ->where(['Records.user_id' => $this->Auth->user('id'), 'Records.result_id' => $idResult])
                    );
        } else {
            $records = $this->paginate($this->Records->find()
                        ->where(['Records.user_id' => $this->Auth->user('id'), 'Records.result_id' => $idResult])
                    );
        }

        $result = $this->Records->Results->get($idResult, ['contain' => ['Players', 'Challenges']]);
        $this->set(compact('records', 'result', 'search'));
    }
    
}
