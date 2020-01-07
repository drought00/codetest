<?php 
namespace App;

class Importer
{
    protected $response;

    protected $error; 

    protected $players;

    // Dev note: 
    // I think Importer should only "import data" from the data provider
    // thus, I made a simple fetch method and formatter to return data.
    // Let me know if this kind of approach is not suitable

	public function __construct()
	{
		$client = curl_init();
        curl_setopt_array($client, array(
            CURLOPT_URL => config('services.provider.endpoint'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $this->response = curl_exec($client);
        $this->error = curl_error($client);
        curl_close($client);
    }

    public function getPlayers()
    {
        if($this->error){
            return $this->error;
        }
        $data = json_decode($this->response,true);
        if($data){
            foreach($data['elements'] as $index => $key){
                $this->players[$index]['player_id'] = $key['id'];
                $this->players[$index]['first_name'] = $key['first_name'];
                $this->players[$index]['second_name'] = $key['second_name'];
                $this->players[$index]['form'] = $key['form'];
                $this->players[$index]['total_points'] = $key['total_points'];
                $this->players[$index]['influence'] = $key['influence'];
                $this->players[$index]['creativity'] = $key['creativity'];
                $this->players[$index]['threat'] = $key['threat'];
                $this->players[$index]['ict_index'] = $key['ict_index'];
                $this->players[$index]['web_name'] = $key['web_name'];
                $this->players[$index]['in_dreamteam'] = $key['in_dreamteam'];
            }
            return $this->players;
        }
        return null;
    }
}