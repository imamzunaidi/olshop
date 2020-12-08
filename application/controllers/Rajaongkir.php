<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Rajaongkir extends CI_Controller{

  // public function __construct(){
  //   parent::__construct();
  //   $this->load->model('m_admin');
  //   $this->load->model('m_kategori');
  // }

  private $api_key = '490f2dcf4e32219c9a86fad4ea510466';
  public function provensi(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: $this->api_key"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      // echo $response;

      $array_response = json_decode($response, TRUE );
      // echo '<pre>';
      // print_r($array_response['rajaongkir']['results']);
      // echo '</pre>';
      echo "<option value = ''>--Pilih Provinsi--</option>";
      $data_provensi = $array_response['rajaongkir']['results'];
      foreach($data_provensi as $key => $value){
        echo "<option value =".$value['province_id']." id_provinsi= ".$value['province_id'].">".$value['province']."</option>";
      }
    }
  }

  public function kota(){
    $curl = curl_init();
    $id_provinsi_terpilih = $this->input->post('id_provinsi');
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi_terpilih,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: $this->api_key"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $array_response = json_decode($response, TRUE );
      echo "<option value = ''>--Pilih Kota--</option>";
      $data_kota = $array_response['rajaongkir']['results'];
      foreach($data_kota as $key => $value){
        echo "<option value =".$value['city_id'].">".$value['city_name']."</option>";
      }
    }
  }

}

?>