<?php

class Model
{
	/**
	 * @param object $db A PDO database connection
	 */
	function __construct($db)
	{
		try {
			$this->db = $db;
		} catch (PDOException $e) {
			exit('Database connection could not be established.');
		}
	}

	/**
	 * amount of messages
	 */
	public function getAmountOfMessages($approved, $filter_date_from, $filter_date_to)
	{
		if ($approved) {

			if (!$filter_date_from) {
				$sql = "SELECT COUNT(id) AS amount_of_messages FROM recados WHERE aprovado = :approved";
				$query = $this->db->prepare($sql);
				$parameters = array(':approved' => $approved);
			}
			else {
				$sql = "SELECT COUNT(id) AS amount_of_messages FROM recados WHERE aprovado = :approved AND (data_envio BETWEEN :filter_date_from AND :filter_date_to)";
				$query = $this->db->prepare($sql);
				$parameters = array(
					':approved'         => $approved,
					':filter_date_from' => $filter_date_from,
					':filter_date_to'   => $filter_date_to
				);
			}

			$query->execute($parameters);
		}
		else {
			$sql = "SELECT COUNT(id) AS amount_of_messages FROM recados";
			$query = $this->db->prepare($sql);
			$query->execute();
		}

		return $query->fetch()->amount_of_messages;
	}

	/**
	 * Get all messages
	 */
	public function getAll($start_from, $per_page, $approved, $filter_date_from, $filter_date_to)
	{
		if ($approved) {

			if (!$filter_date_from) {
				$sql = "SELECT id, nome, email, titulo, texto, aprovado, date_format(data_envio, '%d/%m/%Y %h:%i:%s') data_envio_formatted FROM recados WHERE aprovado = :approved ORDER BY data_envio DESC LIMIT $start_from, $per_page";
				$query = $this->db->prepare($sql);
				$parameters = array(':approved' => $approved);
			}
			else {
				$sql = "SELECT id, nome, email, titulo, texto, aprovado, date_format(data_envio, '%d/%m/%Y %h:%i:%s') data_envio_formatted FROM recados WHERE aprovado = :approved AND (data_envio BETWEEN :filter_date_from AND :filter_date_to) ORDER BY data_envio DESC LIMIT $start_from, $per_page";
				$query = $this->db->prepare($sql);
				$parameters = array(
					':approved'         => $approved,
					':filter_date_from' => $filter_date_from,
					':filter_date_to'   => $filter_date_to
				);
			}

			$query->execute($parameters);
		}
		else {
			$sql = "SELECT id, nome, email, titulo, texto, aprovado, date_format(data_envio, '%d/%m/%Y %h:%i:%s') data_envio_formatted FROM recados ORDER BY data_envio DESC LIMIT $start_from, $per_page";
			$query = $this->db->prepare($sql);
			$query->execute();
		}

		return $query->fetchAll();
	}

	/**
	 * Add a message
	 */
	public function add($data_envio, $nome, $email, $titulo, $texto, $aprovado)
	{
		$sql = "INSERT INTO recados (data_envio, nome, email, titulo, texto, aprovado) VALUES (:data_envio, :nome, :email, :titulo, :texto, :aprovado)";
		$query = $this->db->prepare($sql);

		$parameters = array(
			':data_envio' => $data_envio,
			':nome'       => $nome,
			':email'      => $email,
			':titulo'     => $titulo,
			':texto'      => $texto,
			':aprovado'   => $aprovado
		);

		return $query->execute($parameters);
	}

	public function changeStatus($id, $aprovado)
	{
		$sql = "UPDATE recados SET aprovado = :aprovado WHERE id = :id";
		$query = $this->db->prepare($sql);
		$parameters = array(
			':aprovado' => $aprovado,
			':id'       => $id
		);

		return $query->execute($parameters);
	}

	/**
	 * Delete a message
	 */
	public function remove($id)
	{
		$sql = "DELETE FROM recados WHERE id = :id";
		$query = $this->db->prepare($sql);
		$parameters = array(':id' => $id);

		$query->execute($parameters);
	}

	/**
	 * Get a song from database
	 */
	public function getMessage($id)
	{
		$sql = "SELECT * FROM recados WHERE id = :id";
		$query = $this->db->prepare($sql);
		$parameters = array(':id' => $id);

		$query->execute($parameters);

		return $query->fetch();
	}

}
