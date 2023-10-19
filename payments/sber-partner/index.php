<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "На сайте Stoma26 вы можете воспользоваться предложениями нашего партнера СберБанка. Бонусные программы и удобная оплата по СберКарте!");
$APPLICATION->SetPageProperty("title", "Предложения от СберБанка в интернет-магазине Stoma26");
$APPLICATION->SetTitle("Предложения от СберБанка");?>

<div class="detailed-text">

	<p>У нас на сайте Вы можете воспользоваться предложениями нашего партнера СберБанка</p>
	<p>СберКарта – карта, которая подходит всем!</p>
	<p><b>О карте:</b>
		<ul>
			<li>Одна карта на все случаи жизни</li>
			<li>0 рублей за обслуживание при тратах от 5000 рублей в месяц, иначе – 150 рублей в месяц.</li>
			<li>0% за снятие наличных до 150000 рублей в день в банкоматах СберБанка.</li>
			<li>0% переводы с карты на карту СберБанка до 50000 рублей в месяц.</li>
			<li>Вернем до 10% бонусами. Оплачивайте картой любые покупки. Банк начислит за них бонусы. Обменивайте бонусы на скидки до 99% за покупки у партеров, 1 бонус = 1 рубль.</li>
			<li><b>Подарок для Вашей первой СберКарты и до конца следующего месяца:</b>
				<ul>
					<li>- обслуживание – 0 рублей</li>
					<li>- повышенные бонусы за покупки в кафе и ресторанах 5%.</li>
				</ul>
			</li>
		</ul>
	</p>
	<p>Получать пенсию в СберБанке - надежно и выгодно!</p>
	<p>Переведите пенсию в СберБанк и пользуйтесь привилегиями.</p>
	<p>
		<b>Преимущества:</b>
		<ul>
			<li>Счет Активный возраст с надбавкой для пенсионеров.</li>
			<li>СберВклад с доходностью до 12% годовых.</li>
			<li>Бесплатная СберКарта для пенсионеров.</li>
		</ul>
	</p>
	<br>
	<div class="icon"><img src="/images/pdf_icon.svg"><a href="/images/for_clients.pdf">Для клиентов</a></div>
	<div class="icon"><img src="/images/pdf_icon.svg"><a href="/images/for_new_clients.pdf">Для новых клиентов клиентов</a></div>
	<br>
	<p><b>Форма обратной связи</b></p>

</div>
<?$strEmail = COption::GetOptionString('main','email_from');
//echo($strEmail);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback", 
	"sber-feedback", 
	array(
		"AJAX_MODE" => "Y",
		"USE_CAPTCHA" => "N",
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"EMAIL_TO" => "stoma26.ru@yandex.ru",
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "AUTHOR_PHONE",
		),
		"EVENT_MESSAGE_ID" => array(
		),
		"COMPONENT_TEMPLATE" => "sber-feedback"
	),
	false
);?>

<div class="popup__bg"> 
	<div class="qr-code-popup">
		<div class="qr-code-content">
			<div class="qr-codes">
				<div class="qr-elem">
					<div class="qr-heading">СБОЛ</div>
					<div class="qr-img-container">
						<img src="/images/qr-code1.png">
					</div>
					<div class="qr-text"><a href="https://vitrinadp.sber.ru/apps/general/mix/products/960">https://vitrinadp.sber.ru/apps/general/mix/products/960</a></div>
				</div>
				<div class="qr-elem">
					<div class="qr-heading">ДЛЯ НОВЫХ ПОЛЬЗОВАТЕЛЕЙ</div>
					<div class="qr-img-container">
						<img src="/images/qr-code2.png">
					</div>
					<div class="qr-text"><a href="https://vitrinadp.sber.ru/apps/general/mix/products/1243">https://vitrinadp.sber.ru/apps/general/mix/products/1243</a></div>
				</div>
				<div class="qr-elem">
					<div class="qr-heading">ПЕРЕВОД ПЕНСИИ НА СБЕР</div>
					<div class="qr-img-container">
						<img src="/images/qr-code3.png">
					</div>
					<div class="qr-text"><a href="https://vitrinadp.sber.ru/apps/general/mix/products/963">https://vitrinadp.sber.ru/apps/general/mix/products/963</a></div>
				</div>
			</div>
			<div class="close-btn-container">
				<button class="close-qr-popup">ЗАКРЫТЬ</button>
			</div>
		</div>
	</div>
</div>




<script>
window.addEventListener('DOMContentLoaded', function() {
	const popupBg = document.querySelector(".popup__bg"), 
	 popup = document.querySelector('.qr-code-popup'),
	 closePopup = document.querySelector('.close-qr-popup'), 
	 btnOpen = document.querySelector('.popdef'); 


	 btnOpen.addEventListener('click', () => {
		popupBg.classList.add('active'); 
        popup.classList.add('active'); 
	 });

	closePopup.addEventListener('click', () => {
		popupBg.classList.remove('active'); 
        popup.classList.remove('active'); 
	});
	
	document.addEventListener('click', (e) => { // Вешаем обработчик на весь документ
    	if(e.target === popupBg) { // Если цель клика - фот, то:
        	popupBg.classList.remove('active'); // Убираем активный класс с фона
        	popup.classList.remove('active'); // И с окна
    	}
	});


});
</script>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>