<?php
class Usuario
{
    private $id, $nome, $cpf, $email, $dataNascimento, $senha;

    public function setID($id)
    {
        $this->id = $id;
    }
    public function getID()
    {
        return $this->id;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setCPF($cpf)
    {
        $this->cpf = $cpf;
    }
    public function getCPF()
    {
        return $this->cpf;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setDataNascimento($data)
    {
        $this->dataNascimento = $data;
    }
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    public function inserirBD()
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error)
            die("Falha: " . $conn->connect_error);

        $sql = "INSERT INTO usuario (nome, cpf, email, senha) VALUES ('" . $this->nome . "', '" . $this->cpf . "', '" . $this->email . "', '" . $this->senha . "')";
        if ($conn->query($sql) === true) {
            $this->id = mysqli_insert_id($conn);
            $conn->close();
            return true;
        }
        $conn->close();
        return false;
    }

    public function carregarUsuario($cpf)
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error)
            die("Falha: " . $conn->connect_error);

        $sql = "SELECT * FROM usuario WHERE cpf = '" . $cpf . "'";
        $re = $conn->query($sql);
        $r = $re->fetch_object();
        if ($r != null) {
            $this->id = $r->idusuario;
            $this->nome = $r->nome;
            $this->email = $r->email;
            $this->cpf = $r->cpf;
            $this->dataNascimento = $r->dataNascimento;
            $this->senha = $r->senha;
            $conn->close();
            return true;
        }
        $conn->close();
        return false;
    }

    // MÉTODO ADICIONADO PARA AGENDA 14 (Visualizar por ID)
    public function carregarUsuarioID($id)
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error)
            die("Falha: " . $conn->connect_error);

        $sql = "SELECT * FROM usuario WHERE idusuario = " . $id;
        $re = $conn->query($sql);
        $r = $re->fetch_object();
        if ($r != null) {
            $this->id = $r->idusuario;
            $this->nome = $r->nome;
            $this->email = $r->email;
            $this->cpf = $r->cpf;
            $this->dataNascimento = $r->dataNascimento;
            $this->senha = $r->senha;
            $conn->close();
            return true;
        }
        $conn->close();
        return false;
    }

    public function atualizarBD()
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error)
            die("Falha: " . $conn->connect_error);

        $sql = "UPDATE usuario SET nome='" . $this->nome . "', cpf='" . $this->cpf . "', dataNascimento='" . $this->dataNascimento . "', email='" . $this->email . "' WHERE idusuario='" . $this->id . "'";
        if ($conn->query($sql) === true) {
            $conn->close();
            return true;
        }
        $conn->close();
        return false;
    }

    public function listaCadastrados()
    {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        if ($conn->connect_error)
            die("Falha: " . $conn->connect_error);

        $sql = "SELECT idusuario, nome FROM usuario";
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }
}
?>