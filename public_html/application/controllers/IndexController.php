<?

class IndexController extends ActionController
{
    public function init()
    {
    }

    public function IndexAction()
    {
        $userService = new UserService();

        $this->view->data['persons'] = $userService->getAllPersons();
    }

}
