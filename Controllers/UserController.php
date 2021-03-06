<?php
    namespace Controllers;
    
     use \Exception as Exception;   

    use DAO\UserDAO;
    use DAO\JSON\StudentsDAO;
    use DAO\CompanyDAO as CompanyDAO;
    use DAO\JSON\CareerDAO;
    use Models\User;
    use Models\Students;

    class UserController
    {
        private $StudentsDAO;
        private $UserDAO;
        private $CareerDAO;
        private $CompanyDAO;


        public function __construct()
        {
            $this->StudentsDAO = new StudentsDAO();
            $this->UserDAO = new UserDAO();
            $this->CareerDAO = new CareerDAO();
            $this->CompanyDAO = new CompanyDAO();

        }


         public function login($email = "", $password = "") {               
                $userAux = $this->UserDAO->SearchUserByEmail($email);
                if(!empty($userAux)){
                    
                    $studentAux = $this->StudentsDAO->SearchStudentByEmail($userAux->getEmail());
                    $companyAux = $this->CompanyDAO->SearchCompanyByEmail($userAux->getEmail());
                    if($companyAux){

                        if($userAux->getPassword() == $password){
                            $_SESSION['loggedUser'] = $userAux->getEmail();                   
                            require_once(VIEWS_PATH."pagCompany.php");
                        }else{
                            $this->ShowLoginView("ERROR! USUARIO Y/O password INCORRECTOS");
                        }

                        }else if($studentAux->getActive()==true){
                        if($userAux->getPassword() == $password && $userAux->getAdmin() == 1){

                            $_SESSION['loggedUser'] = $userAux->getEmail();                   
                            require_once(VIEWS_PATH."pagAdmin.php");

                        }
                        elseif($userAux->getPassword() == $password){

                            $_SESSION['loggedUser'] = $userAux->getEmail();
                            require_once(VIEWS_PATH."pagPrincipal.php");

                        }
                        else{            
                        
                            $this->ShowLoginView("ERROR! USUARIO Y/O password INCORRECTOS");                        
                        }                        
                    } 
                    else{                                    
                        $this->ShowLoginView("ERROR! Esta cuenta no esta activa!");
                    }
                }
                else{                          
                    $this->ShowLoginView("ERROR! EL USUARIO NO EXISTE"); 
                }
        }
            
            

        public function Logout(){
            session_destroy();
            header('location: /TP_LabIV');
        }


        public function registerUser($email,$password) {
            
            $User = $this->UserDAO->SearchUserByEmail($email);

            if(empty($User)){

                $Student = $this->StudentsDAO->SearchStudentByEmail($email);
                $Company = $this->CompanyDAO->SearchCompanyByEmail($email);

                if(!empty($Company)){   
                    $newUser = new User();
                    $newUser->setEmail($email);
                    $newUser->setPassword($password);
                    $newUser->setAdmin(2);
                    $this->UserDAO->Add($newUser);

                    $this->ShowLoginView("Registro de Empresa Exitoso!");
                }else if(!empty($Student)){

                        if($Student->getActive()==true){
                        $newUser = new User();
                        $newUser->setEmail($email);
                        $newUser->setPassword($password);
                        $this->UserDAO->Add($newUser);
                        
                        $this->ShowLoginView("Registro de Usuario Exitoso!");
                    }
                    else{                                    
                        $this->ShowLoginView("ERROR! Esta cuenta no esta activa!");
                    }
                }                            
                else{                        
                    $this->ShowLoginView("Email incorrecto");
                }


            }else{                      
                $this->ShowLoginView("ERROR! Ya existe una cuenta registrada con ese email!");
            }
        }

        
        public function StudentStatus()
        {   

            $Student= $this->StudentsDAO->SearchStudentByEmail($_SESSION['loggedUser']);
            $Career = $this->CareerDAO->SearchCareerById($Student->getCareerId());
            require_once(VIEWS_PATH."student-view.php");
            
        }


        public static function CheckUserLog() {
            if(!isset($_SESSION['loggedUser']))
            {
                require_once(VIEWS_PATH."login.php");
            }

            
        }

            public function ShowLoginView($message = "")
            {   
                 echo "<script>alert('$message');</script>"; 
                 echo "<script>setTimeout(\"location.href = '/TP_LabIV';\",1500);</script>"; 
            }


        public function ShowListView()
        {
        $userList = $this->UserDAO->GetAll();
       
        require_once(VIEWS_PATH."user-list.php");
        }

        public function Update($admin,$password,$id){
        
            $this->UserDAO->modify($admin,$password,$id);
            $this->ShowListView();
        } 
        
        public function DeleteUser($id){
            $this->UserDAO->deleteUser($id);
            $this->ShowListView();
        }



        public function ShowUserPassword(){
            $user = $this->UserDAO->SearchUserByEmail($_SESSION['loggedUser']);
            require_once(VIEWS_PATH."student-password.php");
        }

        public function UpdatePassword($password,$password2,$id){
            $this->UserDAO->modifyPassword($password,$id);
            $this->ShowUserPassword();
        }

           public function ShowAddMesaggeView($message = "")
            {
                 echo "<script>alert('$message');</script>"; 
            }
 

        public function ShowApply()
        {
            require_once(VIEWS_PATH."upload-cv.php");
        }

        public function ShowAddApplyMesaggeView($message = "")
        {
             echo "<script>alert('$message');</script>"; 
        }
        


        public function AddCv($cv,$id,$accepted)
        {
            try{
                $nombre = $cv["name"];
                $carpeta = dirname(__DIR__).'/Views/images/Curriculums';

                $temporal = $cv["tmp_name"];

                move_uploaded_file($temporal,$carpeta."/". $nombre);
                    
                $location = '../Views/images/Curriculums/'.$nombre;

                $this->UserDAO->AddCv($location,$id);
                $this->ShowAddMesaggeView("Curriculum cargado con exito!");
                require_once(VIEWS_PATH."upload-cv.php");

            }catch(Exception $ex){
                    $this->ShowAddMesaggeView("Error al cargar CV");
                }
           
            
            //$this->StudentsDAO->Add($aplicant);
        }

    }

?>