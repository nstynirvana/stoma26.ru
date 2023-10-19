<?
/*function nameUpdate()
{
	CModule::IncludeModule("iblock");
	CModule::IncludeModule("catalog");
	CModule::IncludeModule("sale");
	$arSelect = Array("IBLOCK_ID", "ID", "NAME","PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_*", "TIMESTAMP_X", "CATALOG_PRICE_1");
	$arFilter = Array("IBLOCK_ID"=>30, "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1000), $arSelect);
	while($ob = $res->GetNextElement()){
		$arFields = $ob->GetFields();
		$arProps = $ob->GetProperties();
		$prevText = htmlspecialcharsBack($arProps["OPISANIE_TOVARA"]["VALUE"]);
		$propsName = htmlspecialcharsBack($arProps["NAZVANIE_DLYA_SAYTA"]["VALUE"]);
		$arParams = array("replace_space"=>"-","replace_other"=>"-");
		$transCode = Cutil::translit($propsName,"ru",$arParams);
		$date = strtotime($arFields["TIMESTAMP_X"]) - 5;
		$dateUpdate = date("d.m.Y H:i:s", $date);
		$dateUpdateAgent = $arProps["DATE_UPDATE"]["VALUE"];
		$price = $arFields["CATALOG_PRICE_1"];
		$countItem = $arProps["KOLICHESTVO_SHTUK_V_UPAKOVKE"]["VALUE"];
		$propsDesc = htmlspecialcharsBack($arProps["DETALNOE_OPISANIE"]["VALUE"]["TEXT"]);
		if($countItem != ""){
			$newPrice = $countItem * $price;
		}else{
			$newPrice = 1 * $price;
		}
		//echo "<pre>"; print_r($arFields["TIMESTAMP_X"]); echo "</pre>";
		//echo "<pre>"; print_r($dateUpdate); echo "</pre>";
		if(strtotime($dateUpdate) > strtotime($dateUpdateAgent)){
			$el = new CIBlockElement;
			if($prevText != $propsDesc && $prevText != $arFields["PREVIEW_TEXT"]){
				$updateProduct = array(
				"PREVIEW_TEXT" => $prevText,
				"PREVIEW_TEXT_TYPE" => "html",
				"NAME" => $propsName,
				"CODE" => $transCode,
				);
			}else{
				$updateProduct = array(
				"NAME" => $propsName,
				"CODE" => $transCode,
				);
			}
			$PRODUCT_ID = $arFields["ID"];
			$resUpdate = $el->Update($PRODUCT_ID, $updateProduct);

			$ELEMENT_ID = $arFields["ID"];
			$PROPERTY_CODE = "DATE_UPDATE";
			$PROPERTY_VALUE = date("d.m.Y H:i:s");  // значение свойства
			CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));

			$PRODUCT_ID = $arFields["ID"];
			$PRICE_TYPE_ID = 1;

			$arFieldsPrice = Array(
			    "PRODUCT_ID" => $PRODUCT_ID,
			    "CATALOG_GROUP_ID" => $PRICE_TYPE_ID,
			    "PRICE" => $newPrice,
			);

			$resPrice = CPrice::GetList(
			        array(),
			        array(
			                "PRODUCT_ID" => $PRODUCT_ID,
			                "CATALOG_GROUP_ID" => $PRICE_TYPE_ID
			            )
			    );

			if ($arr = $resPrice->Fetch())
			{
			    CPrice::Update($arr["ID"], $arFieldsPrice);
			}
			else
			{
			    CPrice::Add($arFieldsPrice);
			}

		}
	}
	return "nameUpdate();";
}/*


AddEventHandler("main", "OnEpilog", "My404PageInSiteStyle");
function My404PageInSiteStyle()
{
    if(defined('ERROR_404') && ERROR_404 == 'Y')
    {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
        include $_SERVER['DOCUMENT_ROOT'].'/404.php';
        include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
    }
}

?>