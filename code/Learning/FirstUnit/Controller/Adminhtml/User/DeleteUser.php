<?php 


namespace Learning\FirstUnit\Controller\Adminhtml\User;
 
use Magento\Backend\App\Action;
 
class DeleteUser extends Action
{
    protected $_model;
 
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Learning\FirstUnit\Model\TableDataFactory $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
      
     //  $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('User deleted'));
                return   $this->_redirect('usercontrol/user/index');
             //    $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $this->_redirect('usercontrol/user/index');
               // return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('User does not exist'));
        $this->_redirect('usercontrol/user/index');
      //  return $resultRedirect->setPath('*/*/');
    }
}