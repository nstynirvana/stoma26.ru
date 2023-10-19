<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(empty($arResult))
	return "";

$strReturn = "";

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> "" ? " itemref='breadcrumb_".($index + 1)."'" : "");
	$child = ($index > 0 ? " itemprop='child'" : "");
	$arrow = ($index > 0 ? "<span class='breadcrumb__arrow'></span>" : "");

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1) {
		$strReturn .= "<div class='breadcrumb__item' id='breadcrumb_".$index."' itemscope itemprop=\"itemListElement\" itemtype=\"http://schema.org/ListItem\">".$arrow."<a class='breadcrumb__link' href='".$arResult[$index]["LINK"]."' title='".$title."' itemprop=\"item\">".($index == 0 ? "<i class='fa fa-home breadcrumb__icon_main'></i>" : "")."<span class='".($index == 0 ? "breadcrumb__title_main" : "breadcrumb__title")."' itemprop='name'>".$title."</span></a> <meta itemprop=\"position\" content=\"".($index + 1)."\" /></div>";
	} else {
		$strReturn .= "<div class='breadcrumb__item'>".$arrow.($index == 0 ? "<i class='fa fa-home breadcrumb__icon_main'></i>" : "")."<span class='".($index == 0 ? "breadcrumb__title_main" : "breadcrumb__title")."'>".$title."</span></div>";
	}
}

return $strReturn;