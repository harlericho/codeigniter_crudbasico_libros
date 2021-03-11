<?php

namespace App\Controllers;

use App\Models\Libros_model;

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
class Libros extends BaseController
{
	public function index()
	{

		//* vista general del formulario
		//$datos['header'] = view('templates/header');
		//$datos['footer'] = view('templates/footer');
		return view('libros/principal');
	}

	public function listado()
	{
		//* listado de los registros
		if (IS_AJAX) {
			$home_model = new Libros_model();
			$data = $home_model->getTest();
			echo json_encode($data);
		}
	}

	public function guardar()
	{
		//* guardar los registros
		$home_model = new Libros_model();
		$data = [
			'nombre' => $_POST['nombre'],
			'descripcion' => $_POST['des']
		];
		$home_model->entries($data);
		echo true;
	}
	public function ideditar()
	{
		if (IS_AJAX) {
			//* obtner los datos por medio del id
			$home_model = new Libros_model();

			$id = ['id' => $_POST['idEditar']];

			$post = $home_model->getTestID($id);
			$arrayName = [
				'res' => 'suc',
				'post' => $post
			];
			//? codigo para actualizar dato sin Query Builder
			/*
		//$post = $home_model->find($_POST['idEditar']);
		$arrayName = [
			'res' => 'suc',
			'post' => $post
		];
		*/
			return json_encode($arrayName);
		}
	}

	public function actualizar()
	{
		//* actualizar los regisroa
		$home_model = new Libros_model();
		$data = [
			'id' => $_POST['id'],
			'nombre' => $_POST['nombre'],
			'descripcion' => $_POST['des']
		];
		$home_model->entries_update($data);
		echo true;
	}

	public function eliminar()
	{
		//* cambiar el estado del registro
		$home_model = new Libros_model();
		$data = [
			'id' => $_POST['idEliminar'],
			'estado' => 'I'
		];
		$home_model->destroy($data);
		//! eliminar los registros
		/*
		$home_model = new Libros_model();
		$id = ['id' => $_POST['idEliminar']];
		$home_model->destroy($id);
		*/
		echo true;
	}
}
