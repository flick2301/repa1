<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>


<?if(CSite::InDir('/rasprodaja-krepeja/')) $title_menu = "Распродажа крепежа";?>
<?if(CSite::InDir('/certificates/')) $title_menu = "Сертификаты";?>
<?if(CSite::InDir('/catalog/')) $catalog_title_menu = "Каталог";?>
<?$index=0;?>
<div class="basic-layout__module table-of-contents" id="table-of-contents">
    
    <ul class="table-of-contents__list">
    <?foreach($arResult as $arItem):?>
        <?if($arItem['ADDITIONAL_LINKS']["IS_PARENT"] && $index!=0):?>
			</ul>

		</li>
		<?endif;?>
		
        <?if( $arItem['ADDITIONAL_LINKS']["IS_PARENT"]):?>
        <li class="table-of-contents__item parent" style='color:#676767'><span>+</span> <a href="<?=$arItem['LINK']?>" title='<?=$arItem["TEXT"]?>' class="table-of-contents__link"><?=$arItem["TEXT"]?></a>
		<ul class='sub-left'>
		<?elseif( !$arItem['ADDITIONAL_LINKS']["IS_PARENT"]):?>
        <li class="table-of-contents__item"><a href="<?=$arItem['LINK']?>" title='<?=$arItem["TEXT"]?>' class="table-of-contents__link"><?=$arItem["TEXT"]?></a></li>	
	<?endif;?>
<?$index++;?>
    <?endforeach?>
	

    </ul>
</div>
<?endif?>

<style>
.parent{cursor:pointer}
.parent .sub-left{display: none;}
.active .sub-left{display: block; list-style-type:circle; padding-left:30px;}

</style>

<script type="text/javascript">
			
			function DropDown(el) {
				this.dd = el;
				this.placeholder = this.dd.children('span');
				this.opts = this.dd.find('ul.dropdown > li');
				this.val = '';
				this.index = -1;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).parents('.parent').toggleClass('active');
						if($(this).parents('.parent').hasClass("active"))
							$(this).text('-');
						else
							$(this).text('+');
						return false;
					});

					obj.opts.on('click',function(){
						var opt = $(this);
						obj.val = opt.text();
						obj.index = opt.index();
						
						obj.placeholder.text('Gender: ' + obj.val);
					});
				},
				getValue : function() {
					return this.val;
				},
				getIndex : function() {
					return this.index;
				}
			}

			$(function() {

				var dd = new DropDown( $('.parent span') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-1').removeClass('active');
					
					
				});

			});
			
		</script>


			
			
				
				
					
				
			
			
	