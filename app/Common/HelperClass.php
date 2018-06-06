<?php
namespace App\Common;
class HelperClass
 { 
    /**
     *   修改env配置文件
     */
	public static function modifyEnv($data)
	{
		$envPath = base_path() . DIRECTORY_SEPARATOR . '.env';
		$contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));
		//遍历，将配置已有的参数修改
		$contentArray->transform(function ($item) use (&$data){
			 foreach ($data as $key => $value){
				if(str_contains($item, $key)){
                    unset($data[$key]);//移除已修改
					return $key . '=' . $value;
				}
			 }
			 return $item;
         });
		$content = implode($contentArray->toArray(), "\n");
		//配置中没有，添加。
		$str = "\n";
		foreach($data as $k=>$v){
			$str .= "\n".$k.'='. $v;
		}
		$content .= $str;
		\File::put($envPath, $content);
	}
   
     /**
     * curl
     * Allen 2016418
     * @param $id 记录id
     * @return 返回
     */
    public static function curl($url,$wap='POST',$param=[],$time=10)
    {
        if ($wap=='POST') {
            $type=1;
        }else{
            $type=0;
        }
        if($param){
            if( is_array($param) ){
                $param = json_encode($param,JSON_UNESCAPED_UNICODE);
            }else{
                $param = http_build_query($param);
            }
        }
        $handle = curl_init();
        curl_setopt_array(
            $handle,
            array(
                CURLOPT_POST => $type, 
                CURLOPT_TIMEOUT=>$time,
                CURLOPT_POSTFIELDS => $param,
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true
            )
        );
        $response = curl_exec($handle); 
        curl_close($handle);  
        if (empty(json_decode($response))) {
            return $response;
        }
        return $response;
    }
    
}

?>