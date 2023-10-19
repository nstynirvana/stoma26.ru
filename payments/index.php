<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "В интернет-магазине Stoma26 вы можете расплатиться следующими способами: наличный расчет, безналичный расчет, оплата банковской картой.");
$APPLICATION->SetPageProperty("title", "Способы оплаты в интернет-магазине Stoma26");
$APPLICATION->SetTitle("Способы оплаты");?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"payments",
	Array(
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"IBLOCK_ID" => "15",
		"IBLOCK_TYPE" => "content",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array("",""),
		"SECTION_ID" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array("",""),
		"SHOW_PARENT_NAME" => "",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>