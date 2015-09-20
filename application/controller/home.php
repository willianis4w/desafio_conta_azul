<?php

/**
 * Class Home
 *
 */
class Home extends Controller
{

	/**
	 * GET: listar recados
	 */
	public function index()
	{
		if( isset($_GET["page"]) ) {
			$page  = $_GET["page"];
		}
		else {
			$page = 1;
		}

		$per_page = 10;

		$start_from = ($page - 1) * $per_page;

		$approved = (isset($_GET['aprovados'])) ? true : false;

		if(isset($_POST['filter_date_from'])) {
			$filter_date_from_formatted = filter_input(INPUT_POST, 'filter_date_from', FILTER_SANITIZE_STRING);
			$filter_date_to_formatted   = filter_input(INPUT_POST, 'filter_date_to', FILTER_SANITIZE_STRING);

			$filter_date_from = DateTime::createFromFormat('d/m/Y H:i', $filter_date_from_formatted);
			$filter_date_from = $filter_date_from->format('Y-m-d H:i:s');

			$filter_date_to = DateTime::createFromFormat('d/m/Y H:i', $filter_date_to_formatted);
			$filter_date_to = $filter_date_to->format('Y-m-d H:i:s');
		}
		else {
			$filter_date_from = $filter_date_to = false;
		}

		$amount_of_messages = $this->model->getAmountOfMessages($approved, $filter_date_from, $filter_date_to);

		$total_pages = ceil($amount_of_messages / $per_page);



		$messages = $this->model->getAll($start_from, $per_page, $approved, $filter_date_from, $filter_date_to);

		require APP . 'view/_templates/header.php';
		require APP . 'view/messages/index.php';
		require APP . 'view/messages/modalViewMessage.php';
		require APP . 'view/_templates/footer.php';
	}

	/**
	 * Post: ver recado
	 */
	public function ver_recado()
	{
		if (isset($_POST)) {

			$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
			$message = $this->model->getMessage($id);

			echo json_encode($message);
			exit;

		}
	}

	/**
	 * GET: adicionar recado
	 */
	public function adicionar_recado()
	{
		require APP . 'view/_templates/header.php';
		require APP . 'view/messages/addMessage.php';
		require APP . 'view/_templates/footer.php';
	}

	/**
	 * POST: registrar recado
	 */
	public function registrar_recado()
	{
		if (isset($_POST)) {

			$nome       = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
			$email      = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
			$titulo     = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
			$texto      = filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING);
			$aprovado   = (isset($_POST["aprovado"])) ? '1' : '0';

			$dateTime   = DateTime::createFromFormat('d/m/Y H:i', $_POST["data_envio"]);
			$data_envio = $dateTime->format('Y-m-d H:i:s');

			$status = $this->model->add($data_envio, $nome, $email, $titulo, $texto, $aprovado);

			if( $status ) {
				header('location: ' . URL . '?inserido');
				exit;
			}

		}

		header('location: ' . URL . 'home/adicionar_recado');
	}

	/**
	 * POST: mudar status do recado
	 */
	public function change_status()
	{
		$id    = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
		$state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);

		$aprovado = ($state === 'true') ? '1' : '0';

		$status = $this->model->changeStatus($id, $aprovado);

		return json_encode($status);
	}

	/**
	 * POST: remover recado
	 */
	public function remove_recado()
	{
		$id    = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

		$status = $this->model->remove($id);

		return json_encode($status);
	}


}
