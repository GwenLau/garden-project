<?php

namespace Controller;

use \W\Model\GardensModel;

public function displayAllInMap()
{

	$gardensModel = new GardensModel();

	$gardens = $gardensModel->findAll();

	echo json_encode($gardens);

	// Start XML file, create parent node
	$doc = domxml_new_doc("1.0");
	$node = $doc->create_element("markers");
	$parnode = $doc->append_child($node);

	// Opens a connection to a MySQL server
	// $connection=mysql_connect ('localhost', $username, $password);
	// if (!$connection) {
	//  die('Not connected : ' . mysql_error());
	// }

	// Set the active MySQL database
	// $db_selected = mysql_select_db($database, $connection);
	// if (!$db_selected) {
	//  die ('Can\'t use db : ' . mysql_error());
	// }

	// Select all the rows in the markers table
	// $query = "SELECT * FROM markers WHERE 1";
	// $result = mysql_query($query);
	// if (!$result) {
	//  die('Invalid query: ' . mysql_error());
	// }

	header("Content-type: text/xml");

	// Iterate through the rows, adding XML nodes for each
	while ($row = @mysql_fetch_assoc($garden)){
		// Add to XML document node
		$node = $doc->create_element("marker");
		$newnode = $parnode->append_child($node);

		$newnode->set_attribute("Name", $row['Name']);
		// $newnode->set_attribute("address", $row['address']);
		$newnode->set_attribute("LAT", $row['LAT']);
		$newnode->set_attribute("LON", $row['LON']);
		// $newnode->set_attribute("type", $row['type']);
	}

		$xmlfile = $doc->dump_mem();
		echo $xmlfile;

	}