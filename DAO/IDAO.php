<?php namespace DAOS;

interface IDAO
{
	// Mandar un dato de tipo object a la BBDD para cargarlo. No retorna nada.
	public function insertar($dato);
	// Mandar un dato de tipo object a la BBDD para cargarlo, retorna el objeto con el ID cargado.
	public function insertarDevolverID($dato);
	// Busca en la tabla la fila con el mismo ID pasado por parametros, y lo retorna en forma de objeto.
	public function buscarPorID($dato);
	// Busca en la tabla la fila con el mismo ID pasado por parametros, y lo borra. No retorna nada.
	public function borrar($dato);
	// Recibe un objeto (ya modificado) por parametros y lo reemplaza en la tabla y lo actualiza.
	public function actualizar($dato);
	// Retorna todas las filas de la tabla en forma de objetos en un array.
	public function traerTodos();
}
?>