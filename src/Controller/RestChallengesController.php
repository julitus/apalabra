<?php
namespace App\Controller;

use Rest\Controller\RestController;
use Cake\Event\Event;

class RestChallengesController extends RestController
{

	public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');

    }

    public function beforeFilter(Event $event)
    {
        $this->loadModel('Challenges');
        $this->Auth->allow();
    }

    public function getChallenges()
    {
    	if ($this->request->is('post')) {

    		$data = $this->request->getData();

    		$challenges = $this->Challenges->find()
    							->where(['Challenges.user_id' => $data['creator_id'], 'Challenges.active' => true])
    							->contain(['Results' => function($q) {
                                    return $q->select(['Results.challenge_id', 'Results.attemps', 'Results.best_score'])->where(['Results.player_id' => $this->payload->id]);
                                }])
    							->order(['Challenges.name' => 'ASC']);

    		$this->set(compact('challenges'));
            $this->response->statusCode(200);
    	}
    }

    public function getChallenge()
    {
    	if ($this->request->is('post')) {

    		$data = $this->request->getData();

    		$questions = $this->Challenges->Questions->find()
    							->where(['Questions.challenge_id' => $data['challenge_id']]);

    		$this->set(compact('questions'));
            $this->response->statusCode(200);
    	}
    }

    public function saveResult()
    {
    	if ($this->request->is('post')) {

    		$this->loadModel('Connections');

    		$data = $this->request->getData();
    		$data['player_id'] = $this->payload->id;

    		$result = $this->Challenges->Results->find()
    						->where(['Results.player_id' => $data['player_id'], 'Results.challenge_id' => $data['challenge_id']])->first();

    		if (is_null($result)) {
    			$result = $this->Challenges->Results->newEntity();
    			$result->player_id = $this->payload->id;
    			$result->challenge_id = $data['challenge_id'];
    			$result->attemps = 0;
    			$result->best_score = 0;
    		}
    		$result->attemps += 1;
    		$result->best_score = max($result->best_score, (float)$data['score']);

    		if ($this->Challenges->Results->save($result)) {

    			$data['result_id'] = $result->id;
    			$record = $this->Challenges->Records->newEntity($data);
    			$this->Challenges->Records->save($record);

    			$challenge = $this->Challenges->get($data['challenge_id']);
    			$challenge->attemps += 1;
    			$this->Challenges->save($challenge);

    			$connection = $this->Connections->find()
    								->where(['Connections.player_id' => $data['player_id'], 'Connections.user_id' => $challenge->user_id])->first();
    			$connection->attemps += 1;
    			$this->Connections->save($connection);

    			$this->response->statusCode(200);

    		} else {
    			$err = 'NO_SAVE';
                $msg = "Lo sentimos, no se guardó sus resultados, hubo un problema en la conexión";
                $this->set(compact('err', 'msg'));
                $this->response->statusCode(400);
    		}

    	}
    }
}