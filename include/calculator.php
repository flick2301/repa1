<p>
	 * расчет производится в соответствии с регламентом монтажа, заполнения отверстия на 2/3. Установка считается правильной, если излишки химического состава выступили из отверстия. В случае использования сетчатой гильзы (пустотелые основания) необходимо прибавить 30%, так как в данном случае гильза заполняется полностью!
</p>



<script>// <![CDATA[
__FC_FORMULA = ['rez=({vbal}*1000/(({diam}*{diam}*0.25*{h}*3.1076*2)/3))/1','rez2=((((({diam2}*{diam2}*0.25*{h2}*3.14*2)/3)*{qol})/1000)/{vbal2})'];
                __FC_SUBMIT = true;
                __FC_CAPTCHA_TEXT = 'Неверно введены символы с картинки.';
// ]]>
</script>


<p>
 <span class="calcorm-title">Расчет количества отверстий</span>
</p>


<div class="form_descr">
</div>

<form id="calcForm" action="index.php" method="post" name="calcForm">
	<p>
		 Рассчитать на сколько отверстий хватит одного балона HIMTEX
	</p>
	<p>
		 Введите <strong>диаметр</strong> отверстия (в миллиметрах) <input type="text" name="diam" size="4">
	</p>
	<p>
		 Введите <strong>глубину</strong> отверстия (в миллиметрах) <input type="text" name="h" size="4">
	</p>
	<p>
		 Выберите, пожалуйста, объем баллона
		<select name="vbal">
			<option value="300">300 мл</option>
			<option value="385">385 мл</option>
			<option value="400">400 мл</option>
			<option value="410">410 мл</option>
			<option value="585">585 мл</option>
		</select>
	</p>
	<p>
 <span style="font-size: large;"> Количество отверстий: <span id="rez"></span>
</span>
	</p>
 <br>
 
 <span class="calcorm-title">Расчет количества баллонов</span>
 
	<div class="form_descr">
		 
	</div>
	<p>
		 Рассчитать сколько баллонов хим анкера нужно для заданного количества отверстий
	</p>
	<p>
		 Введите <strong>диаметр</strong> отверстия (в миллиметрах) <input type="text" name="diam2" size="4">
	</p>
	<p>
		 Введите <strong>глубину</strong> отверстия (в миллиметрах) <input type="text" name="h2" size="4">
	</p>
	<p>
		 Введите <strong>сколько необходимо </strong> отверстий <input type="text" name="qol" size="4">
	</p>
	<p>
		 Выберите, пожалуйста, объем баллона
		<select name="vbal2">
			<option value="300">300 мл</option>
			<option value="385">385 мл</option>
			<option value="400">400 мл</option>
			<option value="410">410 мл</option>
			<option value="585">585 мл</option>
		</select>
	</p>
 <br>
	<p>
 <span style="font-size: large;"> Количество баллонов анкера: <span id="rez2"></span>
	</p>
</form>




<script>
$(document).ready(function() {
	
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('$(\'#6 8[C=m], #6 o\').x(\'y z\',A(){$(q).5($(q).5().B(/[^0-9\\.]+/,\'\'));4 c=$(\'#6 8[7=c]\').5();4 h=$(\'#6 8[7=h]\').5();4 i=$(\'#6 o[7=i]\').5();e(c&&h&&i){4 a=(i*u/((c*c*0.s*h*3.E*2)/ 3)) /1;a=v.F(a);e(a==0)a=0;$(\'#n\').m(a);$(\'#n\').l(\'f\',\'t\')}w $(\'#n\').l(\'f\',\'r\');4 d=$(\'#6 8[7=d]\').5();4 k=$(\'#6 8[7=k]\').5();4 j=$(\'#6 8[7=j]\').5();4 g=$(\'#6 o[7=g]\').5();e(d&&k&&j&&g){4 b=((((d*d*0.s*k*3.D*2)/3)*j)/ u) /g;b=v.G(b);e(b==0)b=0;$(\'#p\').m(b);$(\'#p\').l(\'f\',\'t\')}w $(\'#p\').l(\'f\',\'r\')});',43,43,'||||var|val|calcForm|name|input||result|result2|diam|diam2|if|display|vbal2||vbal|qol|h2|css|text|rez|select|rez2|this|none|25|flex|1000|Math|else|on|keyup|change|function|replace|type|14|1076|floor|ceil'.split('|'),0,{}))
	
	
<?/*	$('#calcForm input[type=text], #calcForm select').on('keyup change', function() {
		
		$(this).val($(this).val().replace(/[^0-9\.]+/, ''));
		
		var diam = $('#calcForm input[name=diam]').val();
		var h = $('#calcForm input[name=h]').val();
		var vbal = $('#calcForm select[name=vbal]').val();
		
		if (diam && h && vbal) {
			var result = (vbal * 1000 / ((diam * diam * 0.25 * h * 3.1076 * 2) / 3)) / 1;
			//result = result.toFixed(2);
			result = Math.floor(result);
			if (result == 0) result = 0;
			$('#rez').text(result);
			$('#rez').css('display', 'flex');
		}
		else $('#rez').css('display', 'none');
		

		var diam2 = $('#calcForm input[name=diam2]').val();
		var h2 = $('#calcForm input[name=h2]').val();		
		var qol = $('#calcForm input[name=qol]').val();
		var vbal2 = $('#calcForm select[name=vbal2]').val();	

		if (diam2 && h2 && qol && vbal2) {
			var result2 = ((((diam2 * diam2 * 0.25 * h2 * 3.14 * 2) / 3) * qol) / 1000) / vbal2;
			//result2 = result2.toFixed(2);
			result2 = Math.ceil(result2);
			if (result2 == 0) result2 = 0;
			$('#rez2').text(result2);
			$('#rez2').css('display', 'flex');
		}
		else $('#rez2').css('display', 'none');		

	});	*/?>
});
</script>




<style>
#calcForm p {
	width: 450px;
	padding: 5px 0;
	max-width: 90%;
}
#calcForm input[type=text] {
	border: 1px solid #000;
	float: right;
	margin-left: 20px;
}
#calcForm select {
	display: block;
	clear: both;
	width: 300px;
	max-width: 90%;
	margin-top: 5px;
}
.form_descr {
	margin: 10px 0;
}
.calcorm-title {
	color: #4F36E3;
	font-size: 24px;
	margin-top: 30px;
	display: block;
}	
#rez, #rez2 {
	display: none;
	float: right;
	background: #4F36E3;
	color: #fff;
	padding: 5px 15px;
	height: 50px;
	min-width: 50px;
	margin-top: -28px;
	margin-right: -3px;
	font-size: 18px;
	line-height: 18px;
	border-radius: 50%;
	text-align: center;
	justify-content: center;
	align-items: center;
	border: 3px solid #fff;
}
</style>