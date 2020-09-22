<?

class UserService extends Service
{   
    public function getAllPersons()
    {
        $userModel = new UserModel();

        return $userModel->fetchComplexAll();
    }
}  
