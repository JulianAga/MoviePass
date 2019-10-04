<?php
    namespace Repository;

    use Models\Cuenta as Cuenta;

    interface IAccountRepository
    {
        function Add(Cuenta $newAccount);
        function GetAll();
        function GetByEmail($email);
    }
?>