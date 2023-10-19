<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<script type="text/javascript">
	BX.ready(function() {
			//FANCYBOX//
			$(".fancybox").fancybox({
				"transitionIn": "elastic",
				"transitionOut": "elastic",
				"speedIn": 600,
				"speedOut": 200,
				"overlayShow": false,
				"cyclic" : true,
				"padding": 20,
				"titlePosition": "over",
				"onComplete": function() {
					$("#fancybox-title").css({"top":"100%", "bottom":"auto"});
				} 
			});
		});
</script>

<div class="license-slider">
	<div class="license-slider-wrapper">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<a rel="lightbox" class="license-image fancybox" href="<?=$arItem['PREVIEW_PICTURE']['SRC']?>"> 
				<img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" width="100%"/>
			</a>
		<?endforeach;?>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
	    $('.license-slider-wrapper').slick({
  			infinite: true,
  			slidesToShow: 3,
  			slidesToScroll: 1,
  			swipe: false,
  			nextArrow:'<div class="license-next-arrow"><svg width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M9 1L1 8.5L9 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>',
  			prevArrow: '<div class="license-prev-arrow"><svg width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M9 1L1 8.5L9 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>',
  			autoplay: true,
  			autoplaySpeed: 4500
		});
</script>
