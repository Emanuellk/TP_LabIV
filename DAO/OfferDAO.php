<?php
    namespace DAO;

    use \Exception as Exception;   
    use Models\Offer as Offer;    
    use DAO\Connection as Connection;

    class OfferDAO 
    {
        private $connection;
        private $tableName = "offers";

        public function Add(Offer $offer){
            try{
                $query = "INSERT INTO ".$this->tableName."(id, idCompany, idJobPosition, title, description, publicationDate,expirationDate,workLoad,salary,requiriments) VALUES (:id, :idCompany, :idJobPosition, :title, :description,:publicationDate,expirationDate,workLoad,salary,requiriments);";
                $parameters["id"] = $offer->getId();
                $parameters["idCompany"] = $offer->getIdCompany();
                $parameters["idJobPosition"] = $offer->getIdJobPosition();
                $parameters["title"] = $offer->getTitle();
                $parameters["description"] = $offer->getDescription();
                $parameters["publicationDate"] = $offer->getPublicationDate();
                $parameters["expirationDate"] = $offer->getExpirationDate();
                $parameters["workLoad"] = $offer->getWorkLoad();
                $parameters["salary"] = $offer->getSalary();                
                $parameters["requirements"] = $offer->getRequirements();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query,$parameters);
            }
            catch(Exception $ex){
                throw $ex;
            }
        }
       
        public function GetAll(){
            try{
                $OfferList = array();

                $query = "SELECT * FROM ".$this->tableName;
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);
                foreach($resultSet as $row)
                {

                    $offer = new Offer();
                    $offer->setId($row["id"]);
                    $offer->setIdCompany($row["idCompany"]);
                    $offer->setIdJobPosition($row["idJobPosition"]);
                    $offer->setTitle($row["title"]);
                    $offer->setDescription($row["description"]);
                    $offer->setPublicationDate($row["publicationDate"]);
                    $offer->setExpirationDate($row["expirationDate"]);
                    $offer->setWorkLoad($row["workLoad"]);
                    $offer->setSalary($row["salary"]);
                    $offer->setRequirements($row["requirements"]);
                    
                    array_push($OfferList,$offer);
                }

                return $OfferList;
            }catch(Exception $ex){
                throw $ex;
            }
        }

        public function SearchOffer($id) {

            try{
                $query = "SELECT * FROM `".$this->tableName."` WHERE id='$id'";
                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query);

                $OfferAux = NULL;
                
                if(!empty($resultSet[0]))
                {        
                    $OfferAux = new Offer($resultSet[0]['id'],$resultSet[0]['idCompany'],$resultSet[0]['idJobPosition'],$resultSet[0]['title'],$resultSet[0]['description'],$resultSet[0]['publicationDate'],$resultSet[0]['expirationDate'],$resultSet[0]['workLoad'],$resultSet[0]['salary'],$resultSet[0]['requirement']);       
                }
                
                return $OfferAux;

            }catch(Exception $ex){
                throw $ex;
            }
        }
       
        

        

        function deleteOffer($id){
            try{
                $query = "DELETE FROM `". $this->tableName."` WHERE id= :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                
                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(Exception $ex){
                throw $ex;
            }
         }
        
         /*
        function updateOffer($id,$idCompany,$idJobPosition,$title,$description,$publicationDate,){
            try
            {
                $query = "UPDATE ".$this->tableName." SET nameOffer=:nameOffer,email=:email,createDate=:createDate,description=:description where id =:id";
                
                $parameters["id"] = $id;
                $parameters["nameOffer"] = $name;
                $parameters["email"] = $email;
                $parameters["createDate"] = $date;
                $parameters["description"] = $description;
                
                $this->connection = Connection::GetInstance();
                    
                $this->connection->ExecuteNonQuery($query, $parameters);
            
            }
            catch(Exception $ex)
            {
                throw $ex;
            }
           
        }*/
    }
?>