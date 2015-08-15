<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Admin\Model\UserTable;

class IndexController extends AbstractActionController {

    var $userObj;
    protected $storage;
    protected $authservice;

    public function __construct() {
        $this->session = new Container('User');
    }

    public function indexAction() {
        $data = $this->getRequest()->getQuery();
        if (!empty($data['username'])) {
            $this->authservice = $this->getAuthService();
            $this->authservice->getAdapter()->setIdentity($data['username'])->setCredential($data['password']);
            $result = $this->authservice->authenticate();
            if ($result->isValid()) {
                $userDetail = (array)$this->authservice->getAdapter()->getResultRowObject();
                $this->success($userDetail);
            } else {
                $data['error_code'] = 1;
                $this->failure($data);
            }              
        }
        die;
    }
    private function getAuthService() {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
        return $this->authservice;
    }
    
    public function success($data = null){
        $data['status'] = "success";
        echo json_encode($data);
        die;
    }
    private function failure($data = null){
        $data['status'] = "fail";
        echo json_encode($data);
        die;
    }
}
