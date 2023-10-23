<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult["ITEMS"]) < 1)
	return;?>

<div class="payment_methods">
	<div class="h3"><?=GetMessage("PAYMENT_METHODS")?></div>
	<ul>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<li>
				<?if ($arItem["NAME"] != "Оплата ТСР" and $arItem["NAME"] != "Компенсация ФСС") {?>
					
					<?if(!empty($arItem["DISPLAY_PROPERTIES"]["URL"])):?>
						<a target="_blank" href="<?=$arItem['DISPLAY_PROPERTIES']['URL']['VALUE']?>" title="<?=$arItem['NAME']?>" rel="nofollow">
					<?else:?>
						<a href="javascript:void(0)" title="<?=$arItem['NAME']?>">
					<?endif;?>
						<img src="<?=$arItem['PICTURE_PREVIEW']['SRC']?>" width="<?=$arItem['PICTURE_PREVIEW']['WIDTH']?>" height="<?=$arItem['PICTURE_PREVIEW']['HEIGHT']?>" alt="<?=$arItem['NAME']?>" />
					</a>
				<?}elseif ($arItem["NAME"] == "Оплата ТСР") {
					$arItem['PICTURE_PREVIEW']['SRC'] = "/upload/iblock/666/xsu4hgu75gyotx9dhmqqw6pgcinnrseo.png";?>
					<a href="javascript:void(0)" title="<?=$arItem['NAME']?>">
						<img src="<?=$arItem['PICTURE_PREVIEW']['SRC']?>" width="<?=$arItem['PICTURE_PREVIEW']['WIDTH']?>" height="<?=$arItem['PICTURE_PREVIEW']['HEIGHT']?>" alt="<?=$arItem['NAME']?>" />
					</a>
				<?}if ($arItem["NAME"] == "Компенсация ФСС") {
					$arItem['PICTURE_PREVIEW']['SRC'] = "/upload/iblock/a32/xglwa42xdtf77oknnacs2x0vapudteem.png";?>
					<a href="javascript:void(0)" title="<?=$arItem['NAME']?>">
						<img src="<?=$arItem['PICTURE_PREVIEW']['SRC']?>" width="<?=$arItem['PICTURE_PREVIEW']['WIDTH']?>" height="<?=$arItem['PICTURE_PREVIEW']['HEIGHT']?>" alt="<?=$arItem['NAME']?>" />
					</a>
				<?}?>


			</li><?global $USER;
			if ($USER -> isAdmin()) {
				//echo "<pre>";
				//print_r($arItem);
				//echo "</pre>";
			}?>
		<?endforeach;?>
	</ul>
</div>

