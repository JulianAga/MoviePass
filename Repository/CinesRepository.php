<?php namespace Repository;

require_once('Repository/IRepository.php');
    use Repository\IRepository as IRepository;
    use models\Cine as Cine;

    class CinesRepository implements IRepository
    {
        private $postsList = array();

        public function getAll(){
            $this->retrieveData();
            return $this->postsList;
        }

        public function add($value){
            $this->retrieveData();
            array_push($this->postsList, $value);
            $this->saveData();
        }

        public function delete($value){
            $this->retrieveData();
            $newList = array();
            foreach ($this->postsList as $post) {
                if($post->getId() != $value){
                    array_push($newList, $post);
                }
            }
    
            $this->postsList = $newList;
            $this->saveData();
        }

        public function disable($id)
        {
            $this->RetrieveData();
            for ($i=0; $i < count($this->postsList); $i++) { 
                # code...
                if($this->postsList[$i]->getId() == $id){
                    $this->postsList[$i]->setHabilitado(false);
                    }

                }
                $this->saveData();
            }
         
            public function modify($id,$direccion,$cine,$valor,$capacidad)
            {
                $this->RetrieveData();
                for ($i=0; $i < count($this->postsList); $i++) { 
                    # code...
                    if($this->postsList[$i]->getId() == $id){
                        $this->postsList[$i]->setDireccion($direccion);
                        $this->postsList[$i]->setNombre($cine);
                        $this->postsList[$i]->setValor_entrada($valor);
                        $this->postsList[$i]->setCapacidad($capacidad);

                        }
    
                    }
                    $this->saveData();
                }

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->postsList as $post)
            {
                $valuesArray["ID"] = $post->getID();
                $valuesArray["cine"] = $post->getNombre();
                $valuesArray["direccion"] = $post->getDireccion();
                $valuesArray["valor"] = $post->getValor_entrada();
                /*$valuesArray["date"] = $post->getDate();*/
                $valuesArray["capacidad"] = $post->getCapacidad();
                $valuesArray["habilitado"] = $post->getHabilitado();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents('data/posts.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->postsList = array();

            if(file_exists('data/posts.json'))
            {
                $jsonContent = file_get_contents('data/posts.json');

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $post = new Cine();
                    $post->setID($valuesArray["ID"]);
                    $post->setNombre($valuesArray["cine"]);
                    $post->setDireccion($valuesArray["direccion"]);
                    $post->setValor_entrada($valuesArray["valor"]);
                    /*$post->setDate($valuesArray["date"]);*/
                    $post->setCapacidad($valuesArray["capacidad"]);
                    $post->setHabilitado($valuesArray["habilitado"]);

                    array_push($this->postsList, $post);
                }
            }
        }

        public function getByID($ID) {
            $this->RetrieveData();
            $flag = false;

            foreach ($this->postsList as $key => $category) {
                if($category->getID() == $ID) {
                 $flag = true;
                 $value = $category;
                }
            }
            return $value;
        }

        
        public function existByID($ID) {
            $this->RetrieveData();
            $flag = false;

            foreach ($this->postsList as $key => $category) {
                if($category->getID() == $ID) {
                 $flag = true;
                }
            }
            return $flag;
        }
    
    }
