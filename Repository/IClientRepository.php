<?php
    namespace Repository;

    use Models\Cliente as Cliente;

    interface IClientRepository
    {
        function Add(Cliente $newClient);
        function GetAll();
        function GetById($id);
    }
?>