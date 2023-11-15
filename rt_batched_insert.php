<?php
class plugin {

        private $sphinxql = false;

        public function init() {
/*                $this->sphinxql = new mysqli('127.0.0.1', '', '', '', 9306);
                $this->sphinxql->query("drop table if exists iss556");
                $this->sphinxql->query("create table iss556(title text)");*/
	}

	public function query($queries) {
                $out = array();
		foreach ($queries as $id=>$query) {
                        $curl = curl_init();
			$t = microtime(true);
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
                        curl_setopt($curl, CURLOPT_URL, 'http://localhost:9308/insert');
                        curl_setopt($curl, CURLOPT_POST, 1);
                        curl_setopt($curl, CURLOPT_POSTFIELDS,
'{
  "index":"iss556",
  "doc":
  {
    "title" : "title"
  }
}');
                        $res = curl_exec($curl);
			$out[$id] = array('latency' => microtime(true) - $t);
		}
                sleep(10);
		return $out;
	}

	public static function report($queriesInfo) {
		return array(
		'Count' => count($queriesInfo));
	}
}
