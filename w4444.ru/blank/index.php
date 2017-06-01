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
		<script src="<?=$SysValue[$_MY]['path_w4a'].$SysValue['common']['path_js'];?>jquery-1.12.4.min.js"></script>
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
			<h2>Тест class W4aBlank:</h2>
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

<!--/TEST AJAX -1-->		
<h3>Тест AJAX-1:  Inside withaut Component(autor: @WEB4.KZ)</h3>
<div class="examples">

    <button name="sample1" class="sample1">Пример 1 (простой)</button>
    <button name="sample2" class="sample2">Пример 2 (post)</button>
    <button name="sample3" class="sample3">Пример 3 (скрипт)</button>
    <button name="sample4" class="sample4">Пример 4 (xml)</button>
    <button name="sample5" class="sample5">Пример 5 (json)</button>

    <script language="javascript" type="text/javascript">
    $('.sample1').click( function() {

        $.ajax({
          url: '<?=$SysValue[$_MY]['path_w4a'].$SysValue['common']['path_ajax'];?>response.php?action=sample1',
          success: function(data) {
            $('.results').html(data);
          }
        });

    });

    $('.sample2').click( function() {

        $.ajax({
          type: 'POST',
          url: '<?=$SysValue[$_MY]['path_w4a'].$SysValue['common']['path_ajax'];?>response.php?action=sample2',
          data: 'name=RequestType&nickname=POST',
          success: function(data){
            $('.results').html(data);
          }
        });

    });

    $('.sample3').click( function() {

        $.ajax({
          dataType: 'script',
          url: '<?=$SysValue[$_MY]['path_w4a'].$SysValue['common']['path_ajax'];?>response.php?action=sample3',
        });

    });

    $('.sample4').click( function() {

        $.ajax({
          dataType: 'xml',
          url: '<?=$SysValue[$_MY]['path_w4a'].$SysValue['common']['path_ajax'];?>response.php?action=sample4',
          success: function(xmldata){
            $('.results').html('');
            $(xmldata).find('item').each(function(){
                $('<li></li>').html( $(this).text() ).appendTo('.results');
            });
          }
        });

    });

    $('.sample5').click( function() {

        $.ajax({
          dataType: 'json',
          url: '<?=$SysValue[$_MY]['path_w4a'].$SysValue['common']['path_ajax'];?>response.php?action=sample5',
          success: function(jsondata){
            $('.results').html('Name = ' + jsondata.name + ', Nickname = ' + jsondata.nickname);
          }
        });

    });
    </script>

    <div class="results">Ждем ответа</div>
</div>
<!--/TEST AJAX -1-->
<!--/TEST AJAX -2-->		
<h3>Тест AJAX-2: Companent: w4a:ajax.user.php (autor: @WEB4.KZ)</h3>
<div class="examples">
<div class="basket">
	<h2>Корзина</h2>
	<span class="w4a-component-basket w4a-ajax-target">2 800 руб. — 1 шт.</span>
	<a href="javascript:void(0)"  class="w4a-ajax" data-component="basket" data-type="TEST-MODE" data-user-id="99">Обновить</a>
</div>
<div class="user">
	<h2>Пользователь</h2>
	<span class="w4a-component-user w4a-ajax-target">Данные из АЯКС не получены</span>
	<a href="javascript:void(0)" class="w4a-ajax" data-component="user" data-type="user-ava" data-user-id="99">Получить данные</a>
</div>
<div class="w4a-ajax-error"></div>
<script language="javascript" type="text/javascript">
	$(document).ready(function(){

		$(".w4a-ajax").click(function(){
			param = {
				TYPE:$(this).attr('data-type'),
				COMPONENT: $(this).attr('data-component'),
				USERID:$(this).attr('data-user-id')
			};
			alert("userID" + $(this).attr('data-user-id'));
			// alert('tutut-'+$(this).data('component')+'->'+$(this).attr('data-type'));
			w4aAjax($(this).attr('data-component'),$(this).attr('data-type'),param);

		});	

	})
  
	function w4aAjax(component,type,param)
	{
		var type = 'test';
		if((component=='basket' || component=='user') && type!='test'){
			$.ajax({
				url: "/ajax.handler.php",
				type: "POST",
				dataType: "html",
				data: {
					TYPE:type,
					COMPONENT:component,
					PARAM:param
					},
				success: function(data){
				$('.w4a-component-'+component+'.w4a-ajax-target').html(data)
				}
			});		
		}else{
			// TEST-MODE
				$.ajax({
				url: "/ajax.handler.php",
				type: "POST",
				dataType: "html",
				data: {
					TYPE:"TEST-MODE",
					COMPONENT:component,
					PARAM:param
					},
				success: function(data){
				$('.w4a-component-basket.w4a-ajax-target').html(data)
				}
			});			
			// $('.examples .w4a-ajax-error').html('неверно задан компонент: <span style="color:red">' + component + '</span>');
		}
	} 
</script>
</div>
<!--/TEST AJAX -2-->
<!--TEST Companent: "Отправка ошибка с сайта по Ctrl + Enter" -->
<?
$APPLICATION->IncludeComponent("w4a:feedback.error", ".default", array(), false);
?>
<!--/TEST Companent-->
<?
	echo $W4aBase->getTest();
?>

    </body>
</html><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>