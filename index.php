<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "В интернет-магазине Stoma26.ru вы можете купить товары для стомы от ведущих брендов. Доставка товара осуществляется по всей России.");
    $APPLICATION->SetTitle("Купить товары для стомы в интернет-магазине Stoma26.ru");
    global $arSetting;
if(in_array("CONTENT", $arSetting["HOME_PAGE"]["VALUE"])):?><h1>Интернет-магазин Stoma26</h1>
<p>
	 STOMA26 – ставропольская медицинская компания по продаже расходных материалов для стомированных пациентов.
</p>
<p>
</p>
<p>
	 В каталоге интернет-магазина stoma26.ru представлен большой выбор повседневных товаров для стомы любого типа и другие сопутствующие расходники:
</p>
<p>
</p>
<ul>
	<li><a href="/catalog/kalopriemniki/">калоприёмники</a> (двухкомпонентные, однокомпонентные, дренируемые, детские, стомные мешки); </li>
	<li><a href="/catalog/katetery-urologicheskie/">катетеры урологические</a> (мужские, женские, детские); </li>
	<li><a href="/catalog/mochepriemniki/">мочеприёмники</a> (ножные, прикроватные); </li>
	<li><a href="/catalog/podguzniki-dlya-vzroslykh/">подгузники для взрослых</a> (открытые, полуоткрытые, закрытые); </li>
	<li><a href="/catalog/sredstva-po-ukhodu-za-stomoy/">средства по уходу за стомой</a> (адсорбирующая пудра, адгезивные пластины, антиклей, защитный крем, герметизирующая паста, очищающие салфетки); </li>
	<li><a href="/catalog/meditsinskie-sredstva-dezinfektsii/">медицинские средства дезинфекции</a>; </li>
	<li><a href="/catalog/ortopedicheskie-izdeliya/">ортопедические изделия;</a></li>
	<li><a href="/catalog/sredstva-maloy-reabilitatsii/">средства малой реабилитации.</a></li>
</ul>
<p>
</p>
<p>
</p>
<p>
</p>
<h2> <b>ПРЕИМУЩЕСТВА РАБОТЫ С НАШИМ ИНТЕРНЕТ-МАГАЗИНОМ:</b> </h2>
<p>
</p>
<ul>
	<li>обслуживаем как юридических, так и физических лиц; </li>
	<li>заказы принимаем на сайте и по телефону; </li>
	<li>услуга «заказать звонок» экономит ваши деньги и время; </li>
	<li>круглосуточная поддержка через <a href="https://stoma26.ru/contacts/">форму обратной связи</a>; </li>
	<li>товарные и кассовые чеки для получения компенсации от Фонда социального страхования; </li>
	<li>&nbsp;быстрая доставка; </li>
	<li>возможность самовывоза; </li>
	<li>удобная оплата (наличные, банковская карта, безналичный расчёт, наложенный платёж, электронный сертификат социального фонда России); </li>
	<li>профессиональная консультация; </li>
	<li>большой выбор качественных товаров для стомированных людей. </li>
</ul>
<p>
</p>
 Для Вашего удобства рекомендуем скачать наше приложение&nbsp;<a href="https://disk.yandex.ru/d/rnprGomyW-WVtQ">Stoma26</a>
<p>
</p><?endif;
    //CANONICAL
    $pageUrl = $APPLICATION->GetCurPageParam();
    $query_str = parse_url($pageUrl);
    
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
    $protocol = 'https://';
    else
    $protocol = 'http://';
    
    parse_str($query_str['query'], $query_params);
    if(!empty($query_params)){
        $APPLICATION->AddHeadString("<link rel='canonical' href='".$protocol.$_SERVER['HTTP_HOST'].$query_str["path"]."'>");
    }
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>