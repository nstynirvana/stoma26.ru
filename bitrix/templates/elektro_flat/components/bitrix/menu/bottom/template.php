<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(empty($arResult))
	return;?>
<link rel="stylesheet" href="style.css">
<ul>
	<?foreach($arResult as $itemIdex => $arItem):?>
		<?if ($arItem["LINK"] == "/catalog/") {?>
			<li class="catalog-sub-menu">
				<a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a>
					
				<div class="sub-menu" style="display: none;">
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"sections-bottom", 
							array(
								"ROOT_MENU_TYPE" => "left",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_USE_GROUPS" => "N",
								"MENU_CACHE_GET_VARS" => array(
								),
								"MAX_LEVEL" => "1",
								"CHILD_MENU_TYPE" => "left",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
								"CACHE_SELECTED_ITEMS" => "N",
								"COMPONENT_TEMPLATE" => "sections-bottom"
							),
							false
						);?>
					</div>
				
			</li>
		<?}else{?>
		<li>
			<a href="<?=$arItem["LINK"]?>"><span><?=$arItem["TEXT"]?></span></a>
		</li><?}?>
	<?endforeach;?>
</ul>