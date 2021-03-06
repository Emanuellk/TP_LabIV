<?php
    namespace Models;

    class Company{
         private $nameCompany;
         private $email;
         private $createDate;
         private $idCompany;
         private $description;

         public function __construct($idCompany = '',$nameCompany = '',$email = '', $createDate = '', $description = '') {
            $this->idCompany = $idCompany;
            $this->nameCompany = $nameCompany; 
            $this->email = $email;
            $this->createDate = $createDate;
            $this->description = $description;
        }


         /**
          * Get the value of nameCompany
          */ 
         public function getNameCompany()
         {
                  return $this->nameCompany;
         }

         /**
          * Set the value of nameCompany
          *
          * @return  self
          */ 
         public function setNameCompany($nameCompany)
         {
                  $this->nameCompany = $nameCompany;

                  return $this;
         }

         /**
          * Get the value of email
          */ 
         public function getEmail()
         {
                  return $this->email;
         }

         /**
          * Set the value of email
          *
          * @return  self
          */ 
         public function setEmail($email)
         {
                  $this->email = $email;

                  return $this;
         }

         /**
          * Get the value of createDate
          */ 
         public function getCreateDate()
         {
                  return $this->createDate;
         }

         /**
          * Set the value of createDate
          *
          * @return  self
          */ 
         public function setCreateDate($createDate)
         {
                  $this->createDate = $createDate;

                  return $this;
         }

         /**
          * Get the value of idCompany
          */ 
         public function getIdCompany()
         {
                  return $this->idCompany;
         }

         /**
          * Set the value of idCompany
          *
          * @return  self
          */ 
         public function setIdCompany($idCompany)
         {
                  $this->idCompany = $idCompany;

                  return $this;
         }

         /**
          * Get the value of description
          */ 
         public function getDescription()
         {
                  return $this->description;
         }

         /**
          * Set the value of description
          *
          * @return  self
          */ 
         public function setDescription($description)
         {
                  $this->description = $description;

                  return $this;
         }
    }
?>