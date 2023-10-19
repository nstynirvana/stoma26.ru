<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(count($arResult) < 1)
	return;

global $arSetting;?>
<?$bool = false;?>
<ul class="left-menu">
	<?$previousLevel = 0;	
	foreach($arResult as $arItem) {
		if($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
			echo str_repeat("</div></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
		}
		
		if($arItem["DEPTH_LEVEL"] == 1) {
			if($arItem["IS_PARENT"]) {?>
				<li class="parent<?=($arItem['SELECTED'] ? ' selected' : '')?>">
					<a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"].($arSetting["CATALOG_LOCATION"]["VALUE"] == "LEFT" ? "<span class='arrow'></span>" : "")?></a>
					<?=($arSetting["CATALOG_LOCATION"]["VALUE"] == "HEADER" ? "<span class='arrow'></span>" : "")?>
					<div class="catalog-section-childs">
			<?} else {
				if ($bool == true) {?>
					<li>
						<a href="/catalog/invalidnye-kolyaski/">Инвалидные коляски</a>
					</li>
					<li>
						<a href="/catalog/khodunki-dlya-invalidov/">Ходунки для инвалидов</a>
					</li>
					<?$bool = false;
				}?>
				<li<?=($arItem["SELECTED"] ? " class='selected'" : "")?>>
					<a href="<?=$arItem['LINK']?>"><?=$arItem["TEXT"]?></a>
				</li>
			<?}
			if ($arItem["LINK"] == "/catalog/tovary-dlya-invalidov/") {
					$bool = true;
				}	
		} elseif($arItem["DEPTH_LEVEL"] == 2) {?>
			<div class="catalog-section-child">
				<a href="<?=$arItem['LINK']?>" title="<?=$arItem['TEXT']?>">
					<span class="child">
						<?/*
						<span class="graph">
							<?if(!empty($arItem["PARAMS"]["ICON"])) {?>
								<i class="<?=$arItem['PARAMS']['ICON']?>" aria-hidden="true"></i>
							<?} elseif(is_array($arItem["PICTURE"])) {?>								
								<img src="<?=$arItem['PICTURE']['SRC']?>" width="<?=$arItem['PICTURE']['WIDTH']?>" height="<?=$arItem['PICTURE']['HEIGHT']?>" alt="<?=$arItem['TEXT']?>" title="<?=$arItem['TEXT']?>" />
							<?} else {?>
								<img src="<?=SITE_TEMPLATE_PATH?>/images/no-photo.jpg" width="50" height="50" alt="<?=$arItem['TEXT']?>" title="<?=$arItem['TEXT']?>" />
							<?}?>
						</span>
						*/?>
						<span class="text-cont">
							<span class="text"><?=$arItem["TEXT"]?></span>
						</span>
					</span>
				</a>
			</div>
		<?} else {
			continue;
		}
		$previousLevel = $arItem["DEPTH_LEVEL"];
			
	}
	if($previousLevel > 1) {
		echo str_repeat("</div></li>", ($previousLevel-1));
	}?>
	<li>
		<a href="/catalog/ortezy/">Ортезы на заказ</a>
	</li>
	<li>
		<a class="sber-href" href="/payments/sber-partner/">Предложения от СберБанка</a>
	</li>
	
	
</ul>

<script type="text/javascript">
	//<![CDATA[
	$(function() {
		<?if($arSetting["CATALOG_LOCATION"]["VALUE"] == "HEADER"):?>			
			$(".top-catalog ul.left-menu").moreMenu();
		<?endif;?>
		$("ul.left-menu").children(".parent").on({
			mouseenter: function() {
				<?if($arSetting["CATALOG_LOCATION"]["VALUE"] == "LEFT") {?>
					var pos = $(this).position(),
						dropdownMenu = $(this).children(".catalog-section-childs"),
						dropdownMenuLeft = pos.left + $(this).width() + 9 + "px",
						dropdownMenuTop = pos.top - 5 + "px";
					if(pos.top + dropdownMenu.outerHeight() > $(window).height() + $(window).scrollTop() - 46) {
						dropdownMenuTop = pos.top - dropdownMenu.outerHeight() + $(this).outerHeight() + 5;
						dropdownMenuTop = (dropdownMenuTop < 0 ? $(window).scrollTop() : dropdownMenuTop) + "px";
					}
					dropdownMenu.css({"left": dropdownMenuLeft, "top": dropdownMenuTop, "z-index" : "9999"});
					dropdownMenu.stop(true, true).delay(200).fadeIn(150);
				<?} elseif($arSetting["CATALOG_LOCATION"]["VALUE"] == "HEADER") {?>
					var pos = $(this).position(),
						menu = $(this).closest(".left-menu"),
						dropdownMenu = $(this).children(".catalog-section-childs"),
						dropdownMenuLeft = pos.left + "px",
						dropdownMenuTop = pos.top + $(this).height() + 13 + "px",
						arrow = $(this).children(".arrow"),
						arrowLeft = pos.left + ($(this).width() / 2) + "px",
						arrowTop = pos.top + $(this).height() + 3 + "px";
					if(menu.width() - pos.left < dropdownMenu.width()) {
						dropdownMenu.css({"left": "auto", "right": "10px", "top": dropdownMenuTop, "z-index" : "9999"});
						arrow.css({"left": arrowLeft, "top": arrowTop});
					} else {
						dropdownMenu.css({"left": dropdownMenuLeft, "right": "auto", "top": dropdownMenuTop, "z-index" : "9999"});
						arrow.css({"left": arrowLeft, "top": arrowTop });
					}
					dropdownMenu.stop(true, true).delay(200).fadeIn(150);
					arrow.stop(true, true).delay(200).fadeIn(150);
				<?}?>
			},
			mouseleave: function() {
				$(this).children(".catalog-section-childs").stop(true, true).delay(200).fadeOut(150);
				<?if($arSetting["CATALOG_LOCATION"]["VALUE"] == "HEADER") {?>
					$(this).children(".arrow").stop(true, true).delay(200).fadeOut(150);
				<?}?>
			}
		});
	});
	//]]>
</script>