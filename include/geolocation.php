<?$APPLICATION->IncludeComponent(
	"altop:geolocation", 
	".default", 
	array(
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "12",
		"SHOW_CONFIRM" => "N",
		"SHOW_DEFAULT_LOCATIONS" => "Y",
		"SHOW_TEXT_BLOCK" => "Y",
		"SHOW_TEXT_BLOCK_TITLE" => "Y",
		"TEXT_BLOCK_TITLE" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"COOKIE_TIME" => "36000000",
		"COMPONENT_TEMPLATE" => ".default",
		"MODE_OPERATION" => "BITRIX"
	),
	false
);?>