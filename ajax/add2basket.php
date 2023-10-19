<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?if(!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("iblock"))
	return;

if(intval($_REQUEST["ID"]) <= 0)
	return;

$qnt = floatval($_REQUEST["quantity"]);

$arItemParams = array();
if(isset($_REQUEST["PROPS"]) && !empty($_REQUEST["PROPS"])):
	$arItemParamsBefore = unserialize(base64_decode(strtr($_REQUEST["PROPS"], "-_,", "+/=")));
	foreach($arItemParamsBefore as $arProp):
		$arItemParams[] = $arProp;
	endforeach;
endif;
if(isset($_REQUEST["SELECT_PROPS"]) && !empty($_REQUEST["SELECT_PROPS"])):
	$select_props = explode("||", $_REQUEST["SELECT_PROPS"]);
	foreach($select_props as $arSelProp):
		$arItemParams[] = unserialize(base64_decode(strtr($arSelProp, "-_,", "+/=")));
	endforeach;
endif;

$arFields = array("QUANTITY" => $qnt, "DELAY" => "N");

$resBasket = CSaleBasket::GetList(
	array(), 
	array(
		"PRODUCT_ID" => intval($_REQUEST["ID"]),
		"FUSER_ID" => CSaleBasket::GetBasketUserID(),
		"LID" => SITE_ID,
		"ORDER_ID" => "NULL",
		"DELAY" => "Y"
	), 
	false, 
	false, 
	array("ID")
);

if($ar = $resBasket->Fetch()){

	if(CSaleBasket::Update($ar["ID"], $arFields)){
		echo "success";	
	}else{
		echo "error";	
	}

}else{

	if(Add2BasketByProductID(intval($_REQUEST["ID"]), $qnt, $arItemParams)){
		echo "success 2";
	}else{

		echo "error 2";	

		echo "кол-во".$qnt;

		if ($ex = $APPLICATION->GetException()){
			echo '<br>'.$ex->GetString();
		}

	}

}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>