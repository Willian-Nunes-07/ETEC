<?php
    class OutrasFormacoes{
        private $id;
        private $idusuario;
        private $inicio;
        private $fim;
        private $descricao;

        //ID
        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }
        //IDUsuario
        public function setIdUsuario($idusuario){
            $this->idusuario = $idusuario;
        }
        public function getIdUsuario(){
            return $this->idusuario;
        }
        //Inicio
        public function setInicio($inicio){
            $this->inicio = $inicio;
        }
        public function getInicio(){
            return $this->inicio;
        }
        //Fim
        public function setFim($fim){
            $this->fim = $fim;
        }
        public function getFim(){
            return $this->fim;
        }
        //Descrição
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        public function getDescricao(){
            return $this->descricao;
        }

        //InserirBD
        public function InserirBD(){
            require_once 'ConexaoBD.php';

            $con = new ConexaoBD();
            $conn = $con->conectar();
            if ($conn->connect_error){
                die("Connection failed: ". $conn->connect_error);
            }
            $sql = "INSERT INTO outrasformacoes (idusuario, inicio, fim, descricao) VALUES ('" . $this->idusuario . "','" . $this->inicio . "','" . $this->fim . "','" . $this->descricao . "')";

            if ($conn->query($sql) === true){
                $this->id = mysqli_insert_id($conn);
                $conn->close();
                return true;
            }
            else{
                $conn->close();
                return false;
            }
        }
        public function excluirBD($id){
            require_once 'ConexaoBD.php';

            $con = new ConexaoBD();
            $conn = $con->conectar();
            if ($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "DELETE FROM outrasformacoes WHERE idoutrasformacoes = '" . $id ."';";

            if ($conn->query($sql) === true){
                $conn->close();
                return true;
            }
            else{
                $conn-close();
                return false;
            }
        }
        public function listaOutrasFormacoes($idusuario){
            require_once 'ConexaoBD.php';

            $con = new ConexaoBD();
            $conn = $con->conectar();
            if ($conn->connect_error){
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM outrasformacoes WHERE idusuario = '" . $idusuario . "'";
            $re = $conn->query($sql);
            $conn->close();
            return $re;
        }
    }
?>