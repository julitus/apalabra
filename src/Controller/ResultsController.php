<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Results Controller
 *
 * @property \App\Model\Table\ResultsTable $Results
 *
 * @method \App\Model\Entity\Result[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResultsController extends AppController
{
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        if (in_array($action, ['index'])) {
            if ($user['role'] == 1) {
                $idChallenge = $this->request->getParam('pass.0');
                $challenge = $this->Results->Challenges->findById($idChallenge)->first();
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
    public function index($idChallenge = null)
    {
        $this->paginate = [
            'contain' => ['Players', 'Challenges'],
        ];
        $results = $this->paginate($this->Results);

        $this->set(compact('results'));

        $this->paginate = [
            'limit' => 20,
            'contain' => ['Players'],
            'sortWhitelist' => [
                'Players.firstname',
                'Results.created',
                'Results.modified',
                'attemps',
                'best_score',
            ],
            'order' => [
                'Results.modified' => 'desc'
            ]
        ];

        $search = '';

        if (isset($this->request->query['search']) and $this->request->query['search'] != '') {
            $search = $this->request->query['search'];
            $w = '%'.$search.'%';
            $results = $this->paginate($this->Results->find()
                        ->where(['Results.challenge_id' => $idChallenge, 'OR' => ["Players.email LIKE" => $w, "CONCAT(firstname, ' ', lastname) LIKE" => $w]])
                    );
        } else {
            $results = $this->paginate($this->Results->find()
                        ->where(['Results.challenge_id' => $idChallenge])
                    );
        }

        $challenge = $this->Results->Challenges->get($idChallenge);
        $this->set(compact('results', 'challenge', 'search'));
    }

    
}
