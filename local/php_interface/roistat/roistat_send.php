<?php

/**
 * Проксилид Roistat
 * array(
 * 'title'   => 'Название лида',        *обязательный
 * 'comment' => 'Текст лида',           *не обязательный
 * 'name'    => 'Имя контакта',         *не обязательный
 * 'email'   => 'Email контакта',       *не обязательный
 * 'phone'   => 'Телефон контакта',     *не обязательный
 * 'visit'   => 'Номер визита',         *не обязательный
 * 'fields'  => [],                     *не обязательный
 * )
 */

class Roistat {

    /**
     * @var string
     * Ключ интеграции CRM
     */
    private $api_key = 'Y2VlNTdhNDVlMjdmMWU4NjZiNjg2ZDk3MGI5ZmFmZWQ6ODQ3MDk=';

    /**
     * @var string
     * Отправлять в CRM (1 - Нет, 0 - Да)
     */
    private $isSkipSending = '1';

    /**
     * @var string
     * Проверять на дубли (1 - Да, 0 - Нет)
     */
    private $isNeedCheckProcess = '0';

    /**
     * @var string
     * Ждать ответ от CRM, что бы получить № сделки (1 - Да, 0 - Нет)
     */
    private $isSync = '0';

    /**
     * @var bool
     * Включить логирование
     */
    private $isLogged = false;

    /**
     * @var array
     * Массив с данными на отправку
     */
    private $_data;

    /**
     * @var string
     * Название сайта (используется в title)
     */
    private $_siteName = '';

    /**
     * @param array $data
     */
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->_data = $this->prepareData($data);
        }
    }

    /**
     * @param string $siteName
     */
    public function setSiteName($siteName)
    {
        $this->_siteName = $siteName;
    }

    /**
     * @param string $isSkipSending
     */
    public function setIsSkipSending($isSkipSending)
    {
        $this->isSkipSending = $isSkipSending;
    }

    /**
     * @param string $isNeedCheckProcess
     */
    public function setIsNeedCheckProcess($isNeedCheckProcess)
    {
        $this->isNeedCheckProcess = $isNeedCheckProcess;
    }

    /**
     * @param string $isSync
     */
    public function setIsSync($isSync)
    {
        $this->isSync = $isSync;
    }

    /**
     * @param bool $isLogged
     */
    public function setIsLogged($isLogged)
    {
        $this->isLogged = $isLogged;
    }

    /**
     * @return bool
     */
    public function sendLead($data = []) {
        if (!empty($data)) {
            $this->_data = $this->prepareData($data);
        }
        if (empty($this->_data)) {
            return false;
        }
        if (isset($this->_data['visit'])) {
            $visit = $this->_data['visit'];
        } else {
            $visit = isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'nocookie';
        }
        try {
            $title = 'Заявка с сайта ' . $this->_siteName . ': ' . isset($this->_data['title']) ? $this->_data['title'] : '';;
            $roistatData = array(
                'roistat' => $visit,
                'key' => $this->api_key,
                'title' => $title,
                'comment' => isset($this->_data['comment']) ? $this->_data['comment'] : null,
                'name' => isset($this->_data['name']) ? $this->_data['name'] : null,
                'email' => isset($this->_data['email']) ? $this->_data['email'] : null,
                'phone' => isset($this->_data['phone']) ? $this->_data['phone'] : null,
                'sync' => $this->isSync,
                'is_need_check_order_in_processing' => $this->isNeedCheckProcess,
                'is_skip_sending' => $this->isSkipSending,
                'is_need_callback' => '0',
                'fields' => isset($this->_data['fields']) ? $this->_data['fields'] : [],
            );

            $ch = curl_init('https://cloud.roistat.com/api/proxy/1.0/leads/add?'. http_build_query($roistatData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res = curl_exec($ch);
            curl_close($ch);

            $this->writeToLog($roistatData, 'Roistat DATA');

            return $res;
        } catch (Exception $exception) {
            $this->isLogged = true;
            $this->writeToLog($exception, 'Exception');
            die();
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function prepareData(array $data) {
        $new_data = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $new_data[$key] = $value;
                continue;
            }
            $pre = strip_tags($value);
            $pre = trim($pre);
            $new_data[$key] = $pre;
        }

        return $new_data;
    }

    /**
     * @param $data
     * @param $title
     * @param $fileName
     * @return false|void
     */
    public function writeToLog($data, $title = '', $fileName = '/log.txt') {
        if ($this->isLogged === false) {
            return false;
        }
        $log = "\n------------------------\n";
        $log .= date("Y.m.d G:i:s") . "\n";
        $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
        $log .= print_r($data, true);
        $log .= "\n------------------------\n";
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . $fileName, $log, FILE_APPEND);
    }

}
