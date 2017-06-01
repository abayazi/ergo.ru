<?php
require_once(dirname(__FILE__) . "/system.class.php");
require_once(dirname(__FILE__) . "/orm.class.php");
require_once(dirname(__FILE__) . "/parser.class.php");
/**
 * Библиотека W4aMail - шаблон для использования
 * @author  WEB for ALL https://web4.kz
 * @version 1.0
 * @package W4aMail
 */
 
class W4aMail {

	/*
     * Конструктор
     * @param int $objID ИД заявки
     */
    function __construct($objID=false) {
        $this->objID = $objID;
		$W4aSys = new W4aSys();
		$W4aBase = new W4aBase();	
        $this->SysValue = $W4aSys->SysValue;
        $this->cache = false;
        $this->debug = false;
    }
	/**
		* отправка HTML-письма с вложенными изображениями
	 */
	function send2(){
		// картинки
		$attach = array(
			$_SERVER['DOCUMENT_ROOT'].'/w4a/templates/email/tpl_1/images/ergo.jpg',
			$_SERVER['DOCUMENT_ROOT'].'/w4a/templates/email/tpl_1/images/happy_birthday.jpg'
		);

		
		// чтобы отображалась картинка и ее не было в аттаче
		// путь к картинке задается через CID: - Content-ID
		// тестовый текст
		
		$W4aParser = new W4aParser();
		$W4aParser->SysValue['var']['NAME'] = 'Анатолий Климанский ';
		$text = $W4aParser->getParse($_SERVER['DOCUMENT_ROOT'].'/w4a/templates/email/tpl_1/index.html',true);
		
		$from = "info@w4444.ru";
		$to = "anatoliy.klimanskiy@ergo.ru";
		$subject = "С Днем Рождения дорогой сотрудник!!!";
		 
		// Заголовки письма === >>>
		$headers = "From: $from\r\n";
		//$headers .= "To: $to\r\n";
		$headers .= "Subject: $subject\r\n";
		$headers .= "Date: " . date("r") . "\r\n";
		$headers .= "X-Mailer: zm php script\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: multipart/alternative;\r\n";
		$baseboundary = "------------" . strtoupper(md5(uniqid(rand(), true)));
		$headers .= "  boundary=\"$baseboundary\"\r\n";
		// <<< ====================
		 
		// Тело письма === >>>
		$message  =  "--$baseboundary\r\n";
		$message .= "Content-Type: text/plain;\r\n";
		$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$message .= "--$baseboundary\r\n";
		$newboundary = "------------" . strtoupper(md5(uniqid(rand(), true)));
		$message .= "Content-Type: multipart/related;\r\n";
		$message .= "  boundary=\"$newboundary\"\r\n\r\n\r\n";
		$message .= "--$newboundary\r\n";
		$message .= "Content-Type: text/html; charset=utf-8\r\n";
		$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$message .= $text . "\r\n\r\n";
		// <<< ==============
		 
		// прикрепляем файлы ===>>>
		foreach($attach as $filename){
			$mimeType='image/png';
			$fileContent = file_get_contents($filename,true);
			$filename=basename($filename);
			$message.="--$newboundary\r\n";
			$message.="Content-Type: $mimeType;\r\n";
			$message.=" name=\"$filename\"\r\n";
			$message.="Content-Transfer-Encoding: base64\r\n";
			$message.="Content-ID: <$filename>\r\n";
			$message.="Content-Disposition: inline;\r\n";
			$message.=" filename=\"$filename\"\r\n\r\n";
			$message.=chunk_split(base64_encode($fileContent));
		}
		// <<< ====================
		 
		// заканчиваем тело письма, дописываем разделители
		$message.="--$newboundary--\r\n\r\n";
		$message.="--$baseboundary--\r\n";
		 
		// отправка письма
		$result = mail($to, $subject, $message , $headers);
		var_dump($result);
	}


		// отправка простого HTML-писма
	function send(){
		
		$to="axat@web4.su"; // Адрес получателя
		$subject="Тема сообщения";
		$body="
		 
		<div style='background-color: #DFE9F0;color: #2A5594;font-size: 12px !important;font-weight: normal;margin: 0px 1px 0px 0px;padding: 3px 8px;text-decoration: none;white-space: nowrap;'>Hello, world!</div>
		 
		"; // можно и HTML
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: info@w4444.ru ";
		 
	
		$W4aParser = new W4aParser();
		$W4aParser->SysValue['var']['UserName'] = 'Axat ';
		$disp .= $W4aParser->getParse($_SERVER['DOCUMENT_ROOT'].'/w4a/templates/mail/form_birthday.tpl',true);
		mail($to, $subject, $disp, $headers);
		return true;	
		
		mail('axat@web4.su', 'Я-Агент-Новый', "Я-W4aMail->send()\n".$disp."\n tutut-AddAutoloadClasses");
		return true;
	}
	
		/**
		* пример на получение данных из конфига
		* и пасирование шаблона '/w4a/templates/mail/form_birthday.tpl'
		*/
 	function getTest2(){	
		$this->SysValue['var']['Test'] = 'Axat Bayazi';
		$disp .=print_r($this->SysValue,true);
		$W4aParser = new W4aParser();
		$W4aParser->SysValue['var']['Test'] = 'Axat ';
		$disp .= $W4aParser->getParse($_SERVER['DOCUMENT_ROOT'].'/w4a/templates/mail/form_birthday.tpl',true);
		
		$disp .='tutut-END';
		return $disp;
	}
	
		// пример получения данных из таблицы БД
 	function getTest3(){
		$W4aOrm = new W4aOrm('b_iblock_section');
		
		$disp .=print_r(
		$W4aOrm->select(array('*'),array('IBLOCK_ID'=>'=30'),array('order'=>'IBLOCK_ID ASC'),array('limit'=>'0,31')) , true );
		return $disp;
	}
	
}
/* 
class SendEMail
{
	static $transport = false;

	public $filename = 'index.html',
		   // путь к html шаблону
		   $tplFolder = '',
		   // каталог с картинками
		   $imgFolder = 'images/',
		   $subject = '',
		   $from = '',
		   $fromName = null,
		   $contentType = 'text/html',
		   $charset = 'utf-8';

	private $message, $data;

	public function __construct($options)
	{
		foreach($options as $option => $value)
			$this->$option = $value;
		if (!self::$transport)
			self::$transport = Swift_SmtpTransport::newInstance();
	}

	public function Send($data, $email, $name = null)
	{
		$this->data = $data;
		$this->message = Swift_Message::newInstance();
		$mess =& $this->message;
		
		// подставляем данные в subject письма, если там есть соответствующие теги
		$subject = $this->SubstituteData($this->subject);
		$body = $this->GetBody();
		
		// email и имя получателя
		$mess->setTo($email, $name);
		// от кого
		$mess->setFrom($this->from, $this->fromName);
		// тема письма
		$mess->setSubject($subject);
		// сообщение
		$mess->setBody($body);
		$mess->setContentType($this->contentType);
		$mess->setCharset($this->charset);
		
		$mailer = Swift_Mailer::newInstance(self::$transport);
		return $mailer->send($this->message);
	}

	private function GetBody()
	{
		// считываем шаблон письма
		$body = file_get_contents($this->tplPath.$this->filename);
		// подставляем данные в шаблон
		$body = $this->SubstituteData($body);
		// аттачим все картинки, с подходящими imgPath и расширениями jpg, png, gif, заменяем атрибуты src в тегах img
		// 'self::AddImage' будет работать для php > 5.3, для 5.2 нужно заменить на array($this, 'AddImage')
		return preg_replace_callback('/'.preg_quote($this->imgPath, '/').'((.+)\.(jpg|png|gif))/i', 'self::AddImage', $body);
	}

	// прикрепляем картинку, меняем src
	private function AddImage($matches)
	{
		$path = $this->tplPath."/".$matches[0];
		return $this->message->embed(Swift_Image::fromPath($path));
	}

	// заменяем теги на соответствующие данные
	private function SubstituteData($str)
	{
		if (empty($this->data))
			return $str;
		foreach($this->data as $k => $v)
			$str = str_replace($k, $v, $str);
		return $str;
	}
}
 */








?>