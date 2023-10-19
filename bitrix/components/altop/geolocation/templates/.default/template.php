<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$frame = $this->createFrame("geolocation")->begin("");

use Bitrix\Main\Localization\Loc;

if($arParams["USE_GEOLOCATION"] == "Y"):?>
	<div id="geolocation" class="geolocation">
		<a id="geolocationChangeCity" class="geolocation__link" href="javascript:void(0);"><i class="fa fa-map-marker" aria-hidden="true"></i><span class="geolocation__value"><?=(!empty($arParams["GEOLOCATION_CITY"]) ? $arParams["GEOLOCATION_CITY"] : Loc::getMessage("GEOLOCATION_POSITIONING"));?></span></a>
	</div>
	
	<div class="telephone"><?=(!empty($arResult["CONTACTS"]) ? $arResult["CONTACTS"] : "");?></div>

	<script type="text/javascript">
		//JS_MESSAGE//
		BX.message({		
			GEOLOCATION_POSITIONING: "<?=Loc::getMessage('GEOLOCATION_POSITIONING')?>",
			GEOLOCATION_NOT_DEFINED: "<?=Loc::getMessage('GEOLOCATION_NOT_DEFINED')?>",
			GEOLOCATION_YOUR_CITY: "<?=Loc::getMessage('GEOLOCATION_YOUR_CITY')?>",
			GEOLOCATION_YES: "<?=Loc::getMessage('GEOLOCATION_YES')?>",
			GEOLOCATION_CHANGE_CITY: "<?=Loc::getMessage('GEOLOCATION_CHANGE_CITY')?>",
			GEOLOCATION_POPUP_WINDOW_TITLE: "<?=Loc::getMessage('GEOLOCATION_POPUP_WINDOW_TITLE')?>",
			GEOLOCATION_COMPONENT_PATH: "<?=$this->__component->__path?>",
			GEOLOCATION_COMPONENT_TEMPLATE: "<?=$this->GetFolder();?>",		
			GEOLOCATION_PARAMS: <?=CUtil::PhpToJSObject($arParams["PARAMS_STRING"])?>,		
			GEOLOCATION_SHOW_CONFIRM: "<?=$arParams['SHOW_CONFIRM']?>"
		});

		<?if(empty($arParams["GEOLOCATION_CITY"]) && !$arResult['is_bot']) {?>
			//GEOLOCATION//
			<?if($arParams["MODE_OPERATION"] == "BITRIX") {?>

				var geolocation = {
					country: <?=CUtil::PhpToJSObject($arResult["countryName"])?>,
					region: <?=CUtil::PhpToJSObject($arResult["regionName"])?>,
					city: <?=CUtil::PhpToJSObject($arResult["cityName"])?>
				};
				BX.Geolocation(geolocation);
			<?} elseif(!empty($arResult['yandex_map_api_key'])){
				$this->addExternalJS("https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=".$arResult['yandex_map_api_key']);
				?>

                ymaps.ready(BX.GeolocationYandex);
			<?}else{?>
			    BX("geolocationChangeCity").innerHTML ="<span style='color:red'><?=Loc::getMessage('GEOLOCATION_NO_API_KEY_YANDEX')?></span>";
			   
			<?}?>
		<?}?>
		
		//CHANGE_CITY//
		BX.bind(BX("geolocationChangeCity"), "click", BX.delegate(BX.CityChange, BX));
	</script>
<?else:?>
	<div class="telephone"><?=(!empty($arResult["CONTACTS"]) ? $arResult["CONTACTS"] : "");?></div>
<?endif;

$frame->end();?>