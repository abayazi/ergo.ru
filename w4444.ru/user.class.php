<?php
require_once(dirname(__FILE__) . "/system.class.php");
/**
 * Библиотека W4aUser - класс данные пользователя
 * @author  WEB for ALL https://web4.kz
 * @version 1.0
 * @package W4aUser
 */
 
class W4aUser {

	/*
     * Конструктор
     * @param int $objID ИД заявки
     */
    function __construct($objID=false) {
        $this->objID = $objID;
		$W4aSys = new W4aSys();
		$W4aBase = new W4aBase();	
		$SysValue = $W4aSys->SysValue;
        $this->SysValue = $SysValue;
        $this->cache = false;
        $this->debug = false;
		
		$this->userId = $this->getId();
    }
	
	/* ====================================================
	* Функции по пользователями (сотрудникам)
	 * Битриксовые функции 
	*/
	
	/*
	 * ID User	
	 */
	function getId(){
		global $USER;
		return $USER->GetID();
	}
	
	/*
	 * Full Name User	
	 */
	function getFullName(){
		global $USER;
		return $USER->GetFullName();
	}
	
	/*
	 * Login User	
	 */
	function getILogin(){
		global $USER;
		return $USER->GetLogin();
	}
	
	/*
	 *
	 */
	 function getPhoto($user_id=false){

		 if($user_id===false){
			$rsUser = CUser::GetByID($this->userId); 
		 }else{
			 $rsUser = CUser::GetByID($user_id); 
		 }
		
		$arUser = $rsUser->Fetch(); 
		$arFile = CFile::ResizeImageGet($arUser["PERSONAL_PHOTO"], array('width' => 30, 'height' => 30), BX_RESIZE_IMAGE_PROPORTIONAL , true);
		if(empty($arFile['src'])){
			$src = 'no_foto';
		}else{
			$src = $arFile['src'];
		}
		return $src; 
	 }
	
	/* 	
	 * Проверка на наличие подчиненных сотрудников
	 */
	 function checkSubEmployer($user_id_del=false){
		 global $USER;
		 $arr = $this->getBitrixUserSubEmployees($USER->GetID());
		 if(is_array($arr)){
			 return true;
		 }else{
			 return false;
		 }
	 }
	 
	/* 
	 * Полный Список подчиненных сотрудников
	 */
	 function getBitrixUserSubEmployees($user_id){
		if(CModule::IncludeModule("intranet")){

		   $arUsers = CIntranetUtils::GetSubordinateEmployees($user_id, true);
		   while($User = $arUsers->GetNext()){
				$arr[] = $User['ID'];
		   }
		   return $arr;
		}
	 }
	 
	 
	/*
	 * Опредение ид непосредственного начальника
	*/
	function getBitrixUserManager($user_id) {
        $managers = array();
        $sections = CIntranetUtils::GetUserDepartments($user_id);
        foreach ($sections as $section) {
            $manager = CIntranetUtils::GetDepartmentManagerID($section);
            while (empty($manager)) {
                $res = CIBlockSection::GetByID($section);
                if ($sectionInfo = $res->GetNext()) {
                    $manager = CIntranetUtils::GetDepartmentManagerID($section);
                    $section = $sectionInfo['IBLOCK_SECTION_ID'];
                    if ($section < 1) break;
                } else break;
            }
            If ($manager > 0) $managers[] = $manager;
        }
        return $managers;
    }
	 
	/*
	 * 	// тестовая функция
	*/	

 	function getTest(){
		$sql = "select * from `w4a_bxbp_order_form`";
		$res = mysql_query($sql);
		while($row = mysql_fetch_array($res)){
			$disp .= '<br> <b>'.$row['id'].'.test: </b>';
			$disp .= $row['name'];
		}
		return $disp;
	}
}
?>