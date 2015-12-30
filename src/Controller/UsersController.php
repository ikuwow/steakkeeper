<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    /**
     * Before Filter
     *
     * @param \Cake\Event\Event $event The beforeFilter event.
     * @return void
     */
    public function beforeFilter(\Cake\Event\Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['callback']);
    }

    /**
     * Login action
     *
     * @return \Cake\Network\Response|null
     */
    public function login()
    {
        if (!$this->request->is('post')) {
            // nothing to do
            // display 'login with github' button
        } else {
            $url = $this->GitHub->getAuthorizationUrl(); // it must be here before getState()
            $this->Session->write('oauth2state', $this->GitHub->getState());
            return $this->redirect($url);
        }
    }

    /**
     * Callback Action from GitHub
     *
     * @return \Cake\Network\Response
     */
    public function callback()
    {
        $state = $this->Session->read('oauth2state');
        $this->Session->delete('oauth2state');
        if (empty($state) || ($this->request->query('state') !== $state)) {
            throw new \Cake\Network\Exception\BadRequestException('Invalid state');
        }
        $accessToken = $this->GitHub->getAccessToken('Authorization_code', [
            'code' => $this->request->query('code')
        ]);
        $ghUser = $this->GitHub->getResourceOwner($accessToken)->toArray();

        $user = $this->Users->find()
            ->where(['gh_user_id' => $ghUser['id']])
            ->first();
        if (!empty($user)) { // already registered
            $this->Auth->setUser($user->toArray());
            return $this->redirect(['controller' => 'pages', 'action' => 'top']);
        } else { // newcomer
            $userEntity = $this->Users->newEntity([
                'gh_user_id' => $ghUser['id'],
                'email' => $ghUser['email'], // probably null
                'name' => $ghUser['login'],
                'access_token' => $accessToken->getToken()
            ]);
            if ($this->Users->save($userEntity)) {
                $this->Auth->setUser($userEntity->toArray());
                return $this->redirect(['controller' => 'pages', 'action' => 'top']);
            } else {
                throw new \Cake\Network\Exception\BadRequestException('Unable to register...');
            };
        }
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->set('users', $this->paginate($this->Users));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
