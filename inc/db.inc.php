<?php
// simple little db class. (Já þetta notar ekki PDO, og ekki prepared statements enda eru þau aðallega fyrir performance, ekki öryggi, input eiga að vera þokkalega vel cleaned annaðhvort með addslashes, eða casting.)

class db
{
	var $l;
	var $q;
	var $db;
	var $lastq;

	function db($h, $u, $p, $dbname)
	{
		$this->l = new PDO('mysql:host='.$h.';dbname='.$dbname, $u, $p);
	}

	function query($q, $args = null)
	{
		$this->lastq = $q;
		$sth = $this->l->prepare($q);
		if ($sth === false)
			throw new Exception("SQL Error (" .($this->db) . "): " . (print_r($this->l->errorInfo(), true)) . " Statement: " . $q);
		$this->q = @$sth->execute($args);
		if ($this->q !== false)
			$this->q = $sth;
		else
			throw new Exception("SQL Error (" .($this->db) . "): " . (print_r($sth->errorInfo(), true)) . " Statement: " . $q);

		return $this->q;
	}

	function farr($q=null)
	{
		if (!$q)
			$q = $this->q;

		return $q->fetch(PDO::FETCH_ASSOC);
	}

	function frow($q=null)
	{
		if (!$q)
			$q = $this->q;

		return $q->fetch(PDO::FETCH_NUM);

	}

	function selectrow($q, $args=null)
	{
		return $this->frow($this->query($q,$args));
	}

	function selectarr($q, $args=null)
	{
		return $this->farr($this->query($q, $args));
	}

	function selectall_array($q, $args=null)
	{
		$qi = $this->query($q, $args);
		return $qi->fetchAll(PDO::FETCH_ASSOC);
	}

	function selectall_array_by_key($q, $k, $args=null)
	{
		$qi = $this->query($q, $args);
		$arr = array();
		while ($a = $this->farr())
		{
			$arr[$a[$k]] = $a;
		}
		return $arr;
	}

	function selectall_row($q, $args=null)
	{
		$qi = $this->query($q,$args);
		return $qi->fetchAll(PDO::FETCH_NUM);
	}

	function selectcol($q,$args=null)
	{
		$r = $this->frow($this->query($q,$args));
		return $r[0];
	}

	function nrows()
	{
		return $this->q->rowCount();
	}
}
?>
