<?php


namespace Stock\Http\Controllers\Api\V1\Admin;


use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

trait UtilTrait
{
    /**
     * @param $image
     * @param string $folder
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteFile($image, $folder = 'users')
    {
        if ($image != 'default.png' && $image != 'logo-default.jpg') {
            Storage::disk('public')->delete($folder.'/'.$image);
            return response(['message' => 'delete file','type' => 'success']);
        } else {
            return response(['message' => 'delete error', 'type' => 'error']);
        }
    }

    /**
     * @param Request $request
     * @param string $folder
     * @return bool|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function upload(Request $request, $folder = 'users')
    {
        $nameFile = null;
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = uniqid(date('HisYmd'));
            $extension = $request->image->extension();
            $nameFile = "{$name}.{$extension}";
            $upload = $request->image->storeAs($folder, $nameFile, 'public');

            if (!$upload) {
                dd('caio no false');
            } else {
                return response(['file' => $nameFile]);
            }
        } else if ($request->get('image') == null || $request->get('image') == '') {
            return response(['file' => 'default.png']);
        } else {
            return false;
        }
    }

    /**
     * @param $cnpj
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCnpj($cnpj)
    {
        $client = new Client();
        $url = "http://receitaws.com.br/v1/cnpj/$cnpj";
        return $client->get($url);
    }

    /**
     * @param $cep
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getCep($cep)
    {
        $client = new Client();
        $url = "https://viacep.com.br/ws/$cep/json/";
        return $client->get($url);
    }

    /**
     * @param $valor
     * @return mixed|string
     */
    public function limpaCPF_CNPJ($valor)
    {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }

    /**
     *
     */
    public function initCall()
    {
        $data_clicktocall = array
        (
            "domain_uuid"	=> "0fa8e6f1-d3a5-4617-bb80-2da24e6463d3",
            "domain_name"	=> "drs.myuc2b.com",
            "destination"   => "992257826",
            "extension"   	=> "9172"
        );

        $data_clicktocall_json = json_encode($data_clicktocall);

        $ch = curl_init('http://drs.myuc2b.com:4438/clicktocall/call/destinations/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_clicktocall_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt
        (
            $ch, CURLOPT_HTTPHEADER, array
            (
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_clicktocall_json),
                'Authorization: 23057bed-ae05-44b5-b702-7e4dc2fd65d6'
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 2000);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2000);

        /**
        execute post
         */

        $result = curl_exec($ch);

        /**
        close connection
         */

        curl_close($ch);

        echo $result;
    }


}
