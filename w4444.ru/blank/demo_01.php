<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ТЕстовая страницв");

	// parametrs
$_MY = 'blank';  // парамметр для кастомизации
$_w4aPATH = str_replace($_MY,'w4a/',dirname(__FILE__));

	// include SYSTEM CLASS
include_once($_w4aPATH.'class/system.class.php');
	$W4aSys = new W4aSys();
	$W4aBase = new W4aBase();	
	
	// include USER CLASS
include_once($_w4aPATH.'class/user.class.php');	
	$W4aUser = new W4aUser();
		
	// include $_MY CLASS
include_once($_w4aPATH.'class/'.$_MY.'.class.php');	
	$W4aBlank = new W4aBlank();

		// системная переменная 
	$SysValue = $W4aSys->SysValue;
	
		// переменные 	
	$capture = $W4aBase->getParam('lang.'.$_MY.'_capture');
	echo 'lang.'.$_MY.'_capture';
		// JQ-TEST- счетчик обратного хода
	if($SysValue[$_MY]['test_mode']=='true'){
		$W4aSys->testMode($_MY);
		$testJs = $W4aSys->testJs;
		$testDisp = $W4aSys->testDisp;
		$testFooter = $W4aSys->testFooter;
	}
	
		// если необходимо использовать маскуи ввода в config.ini установить mask='true'
	if($SysValue[$_MY]['mask']=='true'){
		$js_mask = '
		 <script src="'. $SysValue[$_MY]['path_w4a'].$SysValue['common']['path_js'] .'jquery.inputmask.js" type="text/javascript"></script>
        <script src="'. $SysValue[$_MY]['path_w4a'].$SysValue['common']['path_js'] .'jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="'. $SysValue[$_MY]['path_w4a'].$SysValue['common']['path_js'] .'jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="'. $SysValue[$_MY]['path_w4a'].$SysValue['common']['path_js'] .'jquery.inputmask.numeric.extensions.js" type="text/javascript"></script>
        <script src="'. $SysValue[$_MY]['path_w4a'].$SysValue['common']['path_js'] .'jquery.inputmask.custom.extensions.js" type="text/javascript"></script>
		';		
	}else{
		$js_mask = '<!-- НЕ ПОДКЛЮЧЕНЫ Плагины с масской ввода -->';
	}
	
		// если необходимо использовать AJAX ajax='true'
	if($SysValue[$_MY]['ajax']=='true'){
		
		$js_ajax ='<script src="'. $SysValue[$_MY]['path_w4a'].$SysValue['common']['path_js'] .'jquery.min.js" type="text/javascript"></script>';
		
	}else{
		$js_ajax = '<!-- НЕ ПОДКЛЮЧЕНЫ Плагины Ajax -->';
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- Файлы CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" />

        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->	
		
		<!-- JQuery -->
		<script src="<?=$SysValue[$_MY]['path_w4a'].$SysValue['common']['path_js'];?>jquery-3.1.1.min.js"></script>
		<!-- /JQuery -->
		
		<!-- Assets -->	
			<!--Скрипты из папки /w4a/assets-->		
			<?=$testJs;?>
		<!--/Assets -->
		
		<!-- JQ-MaskInput -->
			<?=$js_mask?>
		<!-- /JQ-MaskInput -->
				
		<!-- JQ-Ajax -->
			<?=$js_ajax;?>
		<!-- /JQ-Ajax -->
		
		<!-- Common CSS/JS -->
		<link rel="stylesheet" href="<?=$SysValue[$_MY]['path_w4a'].$SysValue['common']['css'];?>?ver=<?echo time();?>" />
		<script src="<?=$SysValue[$_MY]['path_w4a'].$SysValue['common']['js'];?>?ver=<?echo time();?>"></script>       
		<!-- Common CSS/JS -->
		
		<!-- Order CSS/JS -->	
			<link rel="stylesheet" href="<?=$SysValue[$_MY]['path_w4a'].$SysValue[$_MY]['css'];?>?ver=<?echo time();?>" />
			<script src="<?=$SysValue[$_MY]['path_w4a'].$SysValue[$_MY]['js'];?>?ver=<?echo time();?>"></script>       
		<!-- /Order CSS/JS -->
    </head>
<body>
<header>
	<?=$testDisp;?>
</header>
<main>
	<section class="step1">
		<div style="padding:10px 20px">
		<h2>Описание как использовать шаблон:</h2>
		<ol>
		<li>скопировать папку: /test/blank/ -> /test/НАЗВАНИЕ_КАТАЛОГА/</li>
		<li>В файле: /test/НАЗВАНИЕ_КАТАЛОГА/index.php<br>
				изменить переменную: $_MY = 'blank'; -> $_MY = 'НАЗВАНИЕ_КАТАЛОГА';
		</li>
		<li>скопировать файлы:
			<ol style="padding-left:10px;">
			<li>/test/w4a/templates/css/styles.blank.css -> ./styles.НАЗВАНИЕ_КАТАЛОГА.css</li>			
			<li>/test/w4a/templates/js/js.blank.js -> ./js.НАЗВАНИЕ_КАТАЛОГА.js</li>
			</ol>		
		</li>
		<li>Файл: /test/w4a/class/blank.class.php:</li>
			<ol style="padding-left:10px;">
			<li>скопирвать в файл: /test/w4a/class/НАЗВАНИЕ_КАТАЛОГА.class.php</li>
			<li>Переименовать класс: W4aBlank -> W4aНазвание _каталога</li>
			</ol>
		</ol>
		</div>
			<hr>
		<div>		
			<h2>Тест class W4aCartalog:</h2>
			<?=$W4aBlank->getTest();?>
		</div>
		
		
	</section>
	<section class="step2">

	</section>
	<section class="step3">
	</section>
	<section class="step4">
	</section>
</main>
		
		
<footer>		
	<?=$testFooter;?>			
</footer>	


         <!-- JavaScript -->
 
        <!-- /JavaScript -->

<?php
$w4aJS  = '
<script>
	document.write(\'tutut-Start<br>\');

	document.write(\'tutut-End<br>\');
</script>
';

	echo $w4aJS;

?>

<section class="basket">
	<span class="w4a-component-basket w4a-ajax-target">Данные из АЯКС не получены (basket )</span>
	
	<a href="javascript:void(0)" class="w4a-ajax-send" data-component="basket" data-method="TEST-MODE">Получить данные</a>
</section>

	<!--TEST AJAX -->	
<?
	$component = 'catalog';
	$method = 'getCatalogList';
?>
<section class="<?=$component;?>">	
<h3>Тест AJAX-2: Companent: w4a:ajax.<?=$component;?>.php (autor: @WEB4.KZ)</h3>
<div class="examples">

		<span class="w4a-ajax-target">Данные из АЯКС не получены (<?=$component;?>) </span>	<a href="javascript:void(0)" class="w4a-ajax-send" data-component="<?=$component;?>" data-method="<?=$method;?>">Получить данные</a>
			<!--Параметрыдля передачи в АЯКС-->		
		<div class="w4a-ajax-params">
			<span class="w4a-ajax-data" data-name="name2" data-val="222"></span>
			<span class="w4a-ajax-data" data-name="name3" data-val="333"></span>
			<span class="w4a-ajax-data" data-name="name4" data-val="444"></span>
		</div>
			<!--/Параметрыдля передачи в АЯКС-->

		
		<div class="w4a-component-<?=$component;?> w4a-ajax-error"></div>	
	
	<script language="javascript" type="text/javascript">
		$(document).ready(function(){

			$(".w4a-ajax-send").click(function(){
				
				var c = $(this).attr('data-component');				
				var m = $(this).attr('data-method');
				
				data = new Object();

				data['COMPONENT'] = $(this).attr('data-component');
				data['METHOD'] = $(this).attr('data-method');
				alert("section." + c + " .w4a-ajax-params .w4a-ajax-data");
				var i =0;
				$("section." + c + " .w4a-ajax-params .w4a-ajax-data").each(function(e){

					var n = $(this).attr("data-name");
					var v = $(this).attr("data-val");
					
					// alert('tutut-'+c+'-'+m+'->'+n+'-'+v);
					
					data['PARAMS['+i+'][name]'] ='name-'+i;
					data['PARAMS['+i+'][val]'] ='val-'+i;
					i++;
				})				
				
				alert('tutut-'+$(this).attr('data-component')+'->'+$(this).attr('data-method'));
				w4aAjax($(this).attr('data-component'),$(this).attr('data-method'),data);

			});	

		})
	  
		function w4aAjax(component,method,data)
		{

			// var method = 'test';
			if(method!='test'){
				$.ajax({
					url: "/ajax.handler.php",
					type: "POST",
					dataType: "html",
					data: data,
					success: function(data){
					// $('.w4a-component-'+component+'.w4a-ajax-target').html(data);
					$('section.'+component+' .w4a-ajax-target').html(data);
					}
				});		
			}else{
				// TEST-MODE
					$.ajax({
					url: "/ajax.handler.php",
					type: "POST",
					dataType: "html",
					data: data,
					success: function(data){
					$('section.basket .w4a-ajax-target').html(data);
					}
				});			
			}
		} 
	</script>
</div>
</section>
	<!--/TEST AJAX -->

<!--TEST Companent: "Отправка ошибка с сайта по Ctrl + Enter" -->
<?
$APPLICATION->IncludeComponent("w4a:feedback.error", ".default", array(), false);
?>

<!--/TEST Companent-->
<?
	echo $W4aBase->getTest();

	
	/*рабочий  код запросов к БД*/
	echo '<h2>рабочий  код запросов к БД</h2>';
	require_once($_w4aPATH.'class/orm.class.php');
	$W4aOrm = new W4aOrm('b_iblock_section');
	echo '<pre>';
	print_r(
		$W4aOrm->select(array('*'),array('IBLOCK_ID'=>'=30'),array('order'=>'IBLOCK_ID ASC'),array('limit'=>'0,31'))
		);
	echo '</pre>';
	echo '<h2>Конец-рабочий  код запросов к БД</h2>';
?>
<?
$IBLOCK_ID=30;  //ID нужного информационного блока
$IBLOCK_SECTION_ID = 100;
$quantity = 0;
$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "SECTION_ID"=>$IBLOCK_SECTION_ID);
	/* 
	$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, false, false, array(
		"ID", 
		"IBLOCK_SECTION_ID", 
		"DEPTH_LEVEL",
		"NAME",
		"SORT",  
		"PROPERTY_CML2_ARTICLE"
		));
	 // */	
$res = CIBlockElement::GetList(Array("ID"=>"ASC"), $arFilter, false, false, false);
echo '==Start=======================<pre>';
	if(  CModule::IncludeModule("catalog") ) {
			$res_measure = CCatalogMeasure::getList();
		while($measure = $res_measure->Fetch()) {
			$arrMeasure[$measure['ID']] = $measure['SYMBOL_RUS'];
				// print_r($measure);
		}        
	}

while($arElement = $res->GetNext())
{
			
				// Параметры
			$arrParam = CCatalogProduct::GetByID($arElement['ID']);

				// Base Price
			$PRICE_TYPE_ID = 1; 
			$rsPrices = CPrice::GetList(array(), array('PRODUCT_ID' => $arElement['ID'], 'CATALOG_GROUP_ID' => $PRICE_TYPE_ID));	
			
				// собираем инфу по товару
			if ($arPrice = $rsPrices->Fetch()) 
			{ 
				$prodInfo = ''.$arElement['NAME'].'[' .$arElement['SORT']. ']: '.CurrencyFormat($arPrice["PRICE"], $arPrice["CURRENCY"]) . 
				' Ед. измерения: '.$arrMeasure[$arrParam['MEASURE']];
			}


	
	$i++;
	if($i>5) break;
	
	$flag=false;
	if(empty($arrParam['MEASURE'])  or 1==1 /**/){
		echo '<div style="color:red">I: '.$i.'</div><div>'.$prodInfo;
		if(empty($arrParam['MEASURE'])){
			echo '<span style="color:red">нет Ед. измерения</span></div>';
		}
		// echo '<!--';
		echo "<br>arElement: ";
			print_r($arElement);
		echo "--<br>arPrice: ";		
			print_r($arPrice);
		echo "<br>arrParam: ";
			print_r($arrParam);
		// echo '-->';
		echo "<hr>";
	}
		// вывод товаров у которых нет цены
	if(empty($arPrice["PRICE"])){
			$flag=true;
		echo '<div>'.$prodInfo;
		echo '<span style="color:red">нет Стоимости товара</span></div>';
		echo '<!--';
		echo "<br>arElement: ";
			print_r($arElement);
		echo "--<br>arPrice: ";		
			print_r($arPrice);
		echo "<br>arrParam: ";
			print_r($arrParam);
		echo '-->';
		echo "";
	}
		// вывод товаров у которых нет наименование
	if(empty($arElement['NAME'])){
			$flag=true;
		echo '<div>'.$prodInfo;
		echo '<span style="color:red">нет Наименования товара</span></div>';
		echo '<!--';
		echo "<br>arElement: ";
			print_r($arElement);
		echo "--<br>arPrice: ";		
			print_r($arPrice);
		echo "<br>arrParam: ";
			print_r($arrParam);
		echo '-->';
		echo "";
	}
			// вывод товаров с некорректной валютой
		if(($arPrice['CURRENCY'])!='KZT'){
			$flag=true;
		echo '<div>'.$prodInfo;
		echo '<span style="color:red">используется неправильная валюта: ' .$arPrice['CURRENCY']. '</span></div>';
		echo '<!--';
		echo "<br>arElement: ";
			print_r($arElement);
		echo "--<br>arPrice: ";		
			print_r($arPrice);
		echo "<br>arrParam: ";
			print_r($arrParam);
		echo '-->';
		echo "";
	}
	if($flag!==false){
		echo "<hr>";
		$flag=false;
	}
}
echo '</pre>';

/*===============================================*/
echo '<hr><b style="color:red">ВЫВОД каталогов</b><hr><pre>';

$arSections = getSectionList(
 Array(
    'IBLOCK_ID' => 30,
    'SECTION_ID' => 92
 ),
 Array(
    'NAME',
    'SECTION_PAGE_URL'
 )
);


 // var_dump($arSections);
 print_r($arSections);
echo "</pre>"; 
function getSectionList($filter, $select)
{
   $dbSection = CIBlockSection::GetList(
      Array(
               'LEFT_MARGIN' => 'ASC',
      ),
      array_merge( 
          Array(
             'ACTIVE' => 'Y',
             'GLOBAL_ACTIVE' => 'Y'
          ),
          is_array($filter) ? $filter : Array()
      ),
      false,
      array_merge(
          Array(
             'ID',
             'IBLOCK_SECTION_ID'
          ),
         is_array($select) ? $select : Array()
      )
   );

   while( $arSection = $dbSection-> GetNext(true, false) ){

       $SID = $arSection['ID'];
       $PSID = (int) $arSection['IBLOCK_SECTION_ID'];
		// $PSID = $arSection['IBLOCK_SECTION_ID'];
       $arLincs[$PSID]['CHILDS'][$SID] = $arSection;

       $arLincs[$SID] = &$arLincs[$PSID]['CHILDS'][$SID];
   }

   return array_shift($arLincs);
} 
?>
<div>Вывод списка пользователей</div>
<?
/**-------------------------*/
echo 'test- $rAll: массив пользователей у кого сегодня ДР';

$filter = Array 
( 
"ACTIVE"=> "Y" 
);

$rsUsers = CUser::GetList($by = "personal_birthday", $order = "desc",$filter);
// $today = date('d.m',strtotime("+0 days"));
$today = date('d.m',time());

echo '<b>сегдня: ' . $today .'ДР у : </b><br>';
while($arItem = $rsUsers->GetNext()){ 
		// все пользователи
	// $rAll[$arItem['ID']] = $arItem; 
	
	if(empty($arItem['PERSONAL_BIRTHDAY'])){
		// continue; // пропускаем, если ДР не заполнено
	}
	// парсим ДР представленный в формате ДД.ММ.ГГГГ
	$bd = explode('.',$arItem['PERSONAL_BIRTHDAY']);

	// print_r($bd);
	
	 if($bd[0].'.'.$bd[1] == $today or 1==1){
		  echo "[". $arItem['ID']."] (".$arItem['LOGIN'].") ".
					$arItem['NAME']." ".$arItem['LAST_NAME'].
					" (".$arItem['PERSONAL_BIRTHDAY'].") 
					<br>";	
		 $r[$arItem['ID']] = $arItem; 
		 // массив данных пользователя по ИД
		 $rsUser = CUser::GetByID($arItem['ID']);
		$arUser[$arItem['ID']] = $rsUser->Fetch();
	 }

	 unset($bd);
}

echo '<pre>';
print_r($arUser);
echo '</pre>';
/**-----------work!!!--------------* /
echo 'test- добавление лида';

if (\Bitrix\Main\Loader::includeModule('crm')) 
{ 
    $entity = new CCrmLead; 
    $fields = array( 
        'TITLE' => 'Test' 
    ); 
    echo $entity->add($fields); 
}
//*/
/**-----------work!!!--------------* /
echo 'test- Изменение, удаление лида';
if (\Bitrix\Main\Loader::includeModule('crm')) 
{ 
    $entity = new CCrmLead(true);//true - проверять права на доступ
    $fields = array( 
        'TITLE' => 'Test-888' 
    ); 
	// Изменение лида ИД=5
    $entity->update(6, $fields); 
	
	// удаление лида ИД=5
    // $entity->delete(5); 
}
//*/

/**-----------work!!!--------------* /
	// Добавление простого товара. 
	// Простой товар - это товар, привязанный к сущности в обход каталога товаров. 
	// Он не будет сохранён отдельно в базе.
	
if (\Bitrix\Main\Loader::includeModule('crm')) 
{ 
    $rows = array(); 
    $rows[] = array( 
        'PRODUCT_NAME' => 'Страховка', 'QUANTITY' => 2,   'PRICE' => 300, 
        'MEASURE_CODE' => 796 
    ); 
    $rows[] = array( 
        'PRODUCT_NAME' => 'Выезд менеджера', 'QUANTITY' => 1,  'PRICE' => 100, 
        'MEASURE_CODE' => 796 
    ); 
    // CCrmProductRow::SaveRows('D', 10, $rows);//привязываем к сделке 
    // CCrmProductRow::SaveRows('L', 6, $rows);//к лиду 
    // CCrmProductRow::SaveRows('Q', 1, $rows);//к предложению 
	
    //для счетов несколько иначе - при обновлении или добавлении  указываем отдельным полем 
	 
    // CCrmInvoice::add(array( 
        // 'ORDER_TOPIC' => 'Новый счет', 
        // 'PRODUCT_ROWS' => $rows 
    // )); 
	 
}
 //*/
 
 if (\Bitrix\Main\Loader::includeModule('crm')) 
{ 
    $ttt = CCrmLead::GetListEx( 
                $arOrder = array(),  
                $arFilter = array(),  
                $arGroupBy = false,  
                $arNavStartParams = false,  
                $arSelectFields = array()); 
echo '<pre>';
print_r($ttt);
echo '</pre>';
}

//Получение CODE измерения.

if (\Bitrix\Main\Loader::includeModule('crm')) 
{ 
    //получение списка измерений 
    $ttt = \Bitrix\Crm\Measure::getMeasures(); 
    //получение одного измерения по умолчанию 
    $ttt2 = \Bitrix\Crm\Measure::getDefaultMeasure(); 
    //вернется массив массивов вида: 
    /* 
            [ID] => 1 
            [CODE] => 6 
            [IS_DEFAULT] =>  
            [SYMBOL] => м 
    */ 
	print_r($ttt);
}


?>

<div>проверка GIT -3</div>>











 </body>
</html><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>