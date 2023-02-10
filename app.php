<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


//if (preg_match("/^http(s)?:\/\/kenner\-rus\.ru*$/", @$_SERVER['HTTP_ORIGIN']) || preg_match("/^http(s)?:\/\/kenner\-rus\.ru*$/", @$_SERVER['HTTP_REFERER']) || preg_match("/^http(s)?:\/\/kenner\-rus\.ru*$/", @$_SERVER['REQUEST_URI'])) header("Access-Control-Allow-Origin: https://krep-komp.ru");


class ElementsApi
{
    public $apiName = 'elements'; //users

    protected $method = ''; //GET|POST|PUT|DELETE

    public $requestUri = [];
    public $requestParams = [];

    protected $action = ''; //Название метод для выполнения


    public function __construct() {
       

        //Массив GET параметров разделенных слешем
        $this->requestUri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
        $this->requestParams = $_REQUEST;

        //Определение метода запроса
        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }
		return $this->requestUri;
		
    }

    public function run() {
        //Первые 2 элемента массива URI должны быть "api" и название таблицы
        if(array_shift($this->requestUri) !== 'api' || array_shift($this->requestUri) !== $this->apiName){
            throw new RuntimeException('API Not Found', 404);
        }
        //Определение действия для обработки
        $this->action = $this->getAction();

        //Если метод(действие) определен в дочернем классе API
        if (method_exists($this, $this->action)) {
            return $this->{$this->action}();
        } else {
            throw new RuntimeException('Invalid Method', 405);
        }
    }

    protected function response($data, $status = 500) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data);
    }

    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }

    protected function getAction()
    {
        $method = $this->method;
        switch ($method) {
            case 'GET':
                if($this->requestUri){
                    return 'viewAction';
                } else {
                    return 'indexAction';
                }
                break;
            case 'POST':
                return 'createAction';
                break;
            default:
                return null;
        }
    }

     public function indexAction()
    {
        
        return $this->response('Data not found', 404);
    }

    /**
     * Метод GET
     
     */
    public function viewAction()
    {
        //id должен быть первым параметром после /users/x
        $articul = urldecode(array_shift($this->requestUri));
		
		
		if($articul){
           
			$arFilter = ["=PROPERTY_CML2_ARTICLE"=>(string)$articul];
			$res = CIBlockElement::GetList(Array(), $arFilter, false, [], ['*']);
			while($ob = $res->GetNextElement()){ 
				$arFields = $ob->GetFields();  
				$arProps = $ob->GetProperties();
				
				
			}
			return $this->response(json_encode([$arFields, $arProps, 'DETAIL_PICTRURE_SRC'=>CFile::GetPath($arFields['DETAIL_PICTURE'])]), 200);
        }else{
			return $this->response('Data not found', 404);
		}
    }
}
    

try {
    $api = new ElementsApi();
    echo $api->run();
	
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>