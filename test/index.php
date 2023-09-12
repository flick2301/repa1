<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
global $phone_global;
global $email_global;
?>
<div id="unavailable-window" style='display:block;'>
	<div class="win">
		<div class="win-close" id="close"></div>
		
		<div class="unavailable__box">
						<div class="unavailable__topic">Уточнить наличие:</div>
						
						<div class="unavailable__address">Телефон: <a href="tel:<?=$phone_global?>"><?=$phone_global?></a></div>
						<div class="unavailable__time">Пн-Пт. с 9:00 – 18:00 по Мск. Времени.</div> Почта: <a class="unavailable__email" href="mailto:<?=$email_global?>"><?=$email_global?></a>
		</div>
	</div>
</div>
		
	
<script>
$('.win').on('click', function(e){
		if(e.target.id=='close') {
			$('#unavailable-window').slideUp(0);
		}
	});
</script>
	<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>