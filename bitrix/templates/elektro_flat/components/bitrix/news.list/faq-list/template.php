<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="qa-list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="qa-element" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="qa-element-holder">
		        <a href="#" class="list-opener">
		            <div class="texte">
		                <?=$arItem["NAME"]?>
		            </div>
		            <div class="icon">
	                <div class="icon-holder">
	                    <svg class="more" width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<rect width="16.4146" height="4.10365" transform="matrix(0.731062 0.68231 -0.731062 0.68231 3 0)" fill="#575b71"/>
						<rect width="16.4146" height="4.10365" transform="matrix(-0.731062 0.68231 -0.731062 -0.682311 24 2.80078)" fill="#575b71"/>
						</svg>
	                </div>
	            </div>
		        </a>
		        <div class="qa-element-contents" style="display: none;">
		            <div class="qa-element-contents-holder">
		            	<?=$arItem["PREVIEW_TEXT"]?>
		            </div>
		        </div>
		    </div>
		</div>
	<?endforeach;?>
</div>
