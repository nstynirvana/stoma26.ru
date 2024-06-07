<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Телефон, адрес, электронный почтовый ящик интернет- магазина Stoma26. Всю контактную информацию о магазине Стома26 вы можете найти здесь.");
$APPLICATION->SetPageProperty("title", "Контакты интернет-магазина Stoma26.");
$APPLICATION->SetTitle("Контакты"); ?><h2>STOMA26.ru</h2>
    e-mail: <a href="mailto:stoma26.ru@yandex.ru">stoma26.ru@yandex.ru</a><br>
    <br>
    <p>
        Наш адрес: г. Ставрополь, ул. Льва Толстого , 90 Б
    </p>
    Наши телефоны:<br><a href="tel:+79097516454">+7 (909)751-64-54</a><br><br>
    <a href="tel:88007000031">8 (800) 700-06-89</a><br><br>
    <a href="tel:+79097516454">+7 (959)565-20-16</a><p>(Для звонков с территории Луганской народной республики)</p><br>
    <br>45.031585, 41.952824
    <h2>Схема проезда</h2>
<? $APPLICATION->IncludeComponent(
    "bitrix:map.yandex.view",
    "",
    array(
        "API_KEY" => "",
        "CONTROLS" => array("ZOOM", "TYPECONTROL", "SCALELINE"),
        "INIT_MAP_TYPE" => "MAP",
        "MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:45.031585;s:10:\"yandex_lon\";d:41.952824;s:12:\"yandex_scale\";i:18;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:41.952824;s:3:\"LAT\";d:45.031585;s:4:\"TEXT\";s:10:\"Stoma26.ru\";}}}",
        "MAP_HEIGHT" => "305",
        "MAP_ID" => "1",
        "MAP_WIDTH" => "100%",
        "OPTIONS" => array("ENABLE_DBLCLICK_ZOOM", "ENABLE_DRAGGING")
    )
); ?> <br>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_RECURSIVE" => "N",
        "AREA_FILE_SHOW" => "file",
        "EDIT_MODE" => "html",
        "PATH" => SITE_DIR . "include/form_contact.php"
    ),
    false,
    array(
        'HIDE_ICONS' => 'Y'
    )
); ?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>