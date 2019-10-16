<?php namespace Repository;

require_once('Repository/IRepository.php');
    use Repository\IRepository as IRepository;
    use models\Cine as Cine;

    class CinesRepository implements IRepository
    {
        private $cinesList = array();

        public function getAll(){
            $this->retrieveData();
            return $this->cinesList;
        }

        public function add($value){
            $this->retrieveData();
            $this->fixId($value);
            array_push($this->cinesList, $value);
            $this->saveData();
        }

        public function delete($value){
            $this->retrieveData();
            $newList = array();
            foreach ($this->cinesList as $post) {
                if($post->getId() != $value){
                    array_push($newList, $post);
                }
            }
    
            $this->cinesList = $newList;
            $this->saveData();
        }

        public function disable($id)
        {
            $this->RetrieveData();
            for ($i=0; $i < count($this->cinesList); $i++) { 
                # code...
                if($this->cinesList[$i]->getId() == $id){
                    $this->cinesList[$i]->setHabilitado(false);
                    }

                }
                $this->saveData();
            }
         
            public function modify($id,$direccion,$cine,$valor,$capacidad)
            {
                $this->RetrieveData();
                for ($i=0; $i < count($this->cinesList); $i++) { 
                    # code...
                    if($this->cinesList[$i]->getId() == $id){
                        $this->cinesList[$i]->setDireccion($direccion);
                        $this->cinesList[$i]->setNombre($cine);
                        $this->cinesList[$i]->setValor_entrada($valor);
                        $this->cinesList[$i]->setCapacidad($capacidad);
                        }
    
                    }
                    $this->saveData();
                }

        private function saveData()
        {
            $arrayToEncode = array();

            foreach($this->cinesList as $post)
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
            
            file_put_contents('data/cines.json', $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cinesList = array();

            if(file_exists('data/cines.json'))
            {
                $jsonContent = file_get_contents('data/cines.json');

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

                    array_push($this->cinesList, $post);
                }
            }
        }

        public function getByID($ID) {
            $this->RetrieveData();
            $flag = false;

            foreach ($this->cinesList as $key => $category) {
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

            foreach ($this->cinesList as $key => $category) {
                if($category->getID() == $ID) {
                 $flag = true;
                }
            }
            return $flag;
        }
    
        public function fixId(Cine $cine)
        {
            $id=0;
            if(empty($this->cinesList))
            {
                $cine->setID(1);
            }
            else
            {
                foreach ($this->cinesList as $value) {
                    if($value->getID()> $id)
                    {
                        $id = $value -> getID();
                    }
                }
                $cine->setID($id+1);
            }
        }
    }
