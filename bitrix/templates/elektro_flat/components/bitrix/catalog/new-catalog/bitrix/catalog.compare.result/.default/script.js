(function (window) {

	if(!!window.JCCatalogSection) {
		return;
	}	

	var BasketButton = function(params) {
		BasketButton.superclass.constructor.apply(this, arguments);		
		this.buttonNode = BX.create("button", {
			text: params.text,
			attrs: { 
				name: params.name,
				className: params.className
			},
			events : this.contextEvents
		});
	};
	BX.extend(BasketButton, BX.PopupWindowButton);

	window.JCCatalogSection = function (arParams) {
		this.productType = 0;

		this.checkQuantity = false;
		this.maxQuantity = 0;
		this.stepQuantity = 1;
		this.isDblQuantity = false;
		
		this.precision = 6;
		this.precisionFactor = Math.pow(10, this.precision);

		this.visual = {
			ID: ""
		};
		
		this.product = {			
			id: 0,
			name: "",
			pict: {},
			checkQuantity: false,
			maxQuantity: 0,
			stepQuantity: 1,			
			isDblQuantity: false
		};
			
		this.offer = {
			id: 0
		};

		this.obPopupBtn = null;
		this.obPropsBtn = null;
		this.obBtnBuy = null;
		
		this.obPopupWin = null;
		this.basketParams = {};
			
		this.errorCode = 0;

		if("object" === typeof arParams) {			
			this.visual = arParams.VISUAL;

			if(!!arParams.PRODUCT && "object" === typeof(arParams.PRODUCT)) {
				this.product.id = arParams.PRODUCT.ID;
				this.product.name = arParams.PRODUCT.NAME;
				this.product.pict = arParams.PRODUCT.PICT;

				this.checkQuantity = arParams.PRODUCT.CHECK_QUANTITY;
				this.isDblQuantity = arParams.PRODUCT.QUANTITY_FLOAT;
				if(this.checkQuantity)
					this.maxQuantity = (this.isDblQuantity ? parseFloat(arParams.PRODUCT.MAX_QUANTITY) : parseInt(arParams.PRODUCT.MAX_QUANTITY, 10));
				this.stepQuantity = (this.isDblQuantity ? parseFloat(arParams.PRODUCT.STEP_QUANTITY) : parseInt(arParams.PRODUCT.STEP_QUANTITY, 10));
				if(this.isDblQuantity)
					this.stepQuantity = Math.round(this.stepQuantity * this.precisionFactor) / this.precisionFactor;

				if(!!arParams.OFFER)
					this.offer.id = arParams.OFFER.ID;
			} else {
				this.errorCode = -1;
			}
		}
		if(0 === this.errorCode) {
			BX.ready(BX.delegate(this.Init,this));
		}
	};

	window.JCCatalogSection.prototype.Init = function() {
		this.obQuantityUp = BX("quantity_plus_" + this.visual.ID);
		if(!!this.obQuantityUp)
			BX.bind(this.obQuantityUp, "click", BX.delegate(this.QuantityUp, this));
				
		this.obQuantityDown = BX("quantity_minus_" + this.visual.ID);
		if(!!this.obQuantityDown)
			BX.bind(this.obQuantityDown, "click", BX.delegate(this.QuantityDown, this));

		this.obQuantity = BX("quantity_" + this.visual.ID);
		if(!!this.obQuantity)
			BX.bind(this.obQuantity, "change", BX.delegate(this.QuantityChange, this));

		if(!!this.visual.POPUP_BTN_ID) {
			this.obPopupBtn = BX(this.visual.POPUP_BTN_ID);
			BX.bind(this.obPopupBtn, "click", BX.delegate(this.OpenFormPopup, this));
		}
		
		if(!!this.visual.PROPS_BTN_ID) {
			this.obPropsBtn = BX(this.visual.PROPS_BTN_ID);
			BX.bind(this.obPropsBtn, "click", BX.delegate(this.OpenPropsPopup, this));
		}
		
		if(!!this.visual.BTN_BUY_ID) {
			this.obBtnBuy = BX(this.visual.BTN_BUY_ID);
			BX.bind(this.obBtnBuy, "click", BX.delegate(this.Add2Basket, this));
		}
	};

	window.JCCatalogSection.prototype.QuantityUp = function() {
		var curValue = 0,
			boolSet = true;
		
		curValue = (this.isDblQuantity ? parseFloat(this.obQuantity.value) : parseInt(this.obQuantity.value, 10));
		if(!isNaN(curValue)) {
			curValue += this.stepQuantity;
			if(this.checkQuantity) {
				if(curValue > this.maxQuantity) {
					boolSet = false;
				}
			}
			if(boolSet) {
				if(this.isDblQuantity) {
					curValue = Math.round(curValue * this.precisionFactor) / this.precisionFactor;
				}
				this.obQuantity.value = curValue;
			}
		}
	};

	window.JCCatalogSection.prototype.QuantityDown = function() {
		var curValue = 0,
			boolSet = true;
		
		curValue = (this.isDblQuantity ? parseFloat(this.obQuantity.value) : parseInt(this.obQuantity.value, 10));
		if(!isNaN(curValue)) {
			curValue -= this.stepQuantity;
			if(curValue < this.stepQuantity) {
				boolSet = false;
			}
			if(boolSet) {
				if(this.isDblQuantity) {
					curValue = Math.round(curValue * this.precisionFactor) / this.precisionFactor;
				}
				this.obQuantity.value = curValue;
			}
		}
	};

	window.JCCatalogSection.prototype.QuantityChange = function() {
		var curValue = 0,
			intCount,
			count;
		
		curValue = (this.isDblQuantity ? parseFloat(this.obQuantity.value) : parseInt(this.obQuantity.value, 10));
		if(!isNaN(curValue)) {
			if(this.checkQuantity) {
				if(curValue > this.maxQuantity) {
					curValue = this.maxQuantity;
				}
			}
			if(curValue < this.stepQuantity) {
				curValue = this.stepQuantity;
			} else {
				count = Math.round((curValue * this.precisionFactor) / this.stepQuantity) / this.precisionFactor;
				intCount = parseInt(count, 10);
				if(isNaN(intCount)) {
					intCount = 1;
					count = 1.1;
				}
				if(count > intCount) {
					curValue = (intCount <= 1 ? this.stepQuantity : intCount * this.stepQuantity);
					curValue = Math.round(curValue * this.precisionFactor) / this.precisionFactor;
				}
			}
			this.obQuantity.value = curValue;
		} else {
			this.obQuantity.value = this.stepQuantity;
		}
	};

	window.JCCatalogSection.prototype.OpenPropsPopup = function() {
		var visualId = this.visual.ID,
			elementId = this.product.id,
			offerId = this.offer.id;
		BX.PropsSet =
		{			
			popup: null
		};
		BX.PropsSet.popup = BX.PopupWindowManager.create(visualId, null, {
			autoHide: BX.message("COMPARE_OFFERS_VIEW") == "LIST" ? false : true,
			offsetLeft: 0,
			offsetTop: 0,
			overlay: {
				opacity: 100
			},
			draggable: false,
			closeByEsc: false,
			className: "pop-up more_options" + (offerId > 0 && BX.message("COMPARE_OFFERS_VIEW") == "LIST" ? " offers-list" : ""),
			closeIcon: { right : "-10px", top : "-10px"},
			titleBar: {content: BX.create("span", {html: BX.message("COMPARE_POPUP_WINDOW_MORE_OPTIONS")})},
			content: "<div class='popup-window-wait'><i class='fa fa-spinner fa-pulse'></i></div>",
			events: {
				onAfterPopupShow: function()
				{
					if(!BX(visualId + "_info")) {
						BX.ajax.post(
							BX.message("COMPARE_COMPONENT_TEMPLATE") + "/popup.php",
							{
								sessid: BX.bitrix_sessid(),
								action: "props",
								arParams: BX.message("COMPARE_COMPONENT_PARAMS"),
								ELEMENT_ID: elementId,
								STR_MAIN_ID: visualId
							},
							BX.delegate(function(result)
							{
								this.setContent(result);
								var windowSize =  BX.GetWindowInnerSize(),
								windowScroll = BX.GetWindowScrollPos(),
								popupHeight = BX(visualId).offsetHeight;
								BX(visualId).style.top = windowSize.innerHeight/2 - popupHeight/2 + windowScroll.scrollTop + "px";
							},
							this)
						);
					} else {
						if(offerId > 0) {
							var parentQntInput = BX("quantity_" + visualId),
								qntInput = BX("quantity_" + visualId + "_" + offerId);
							if(!!parentQntInput && !!qntInput)
								qntInput.value = parentQntInput.value;
						}
						var parentQntSelectInput = BX("quantity_" + visualId),
							qntSelectInput = BX("quantity_select_" + visualId);
						if(!!parentQntSelectInput && !!qntSelectInput)
							qntSelectInput.value = parentQntSelectInput.value;
					}
				}
			}
		});

		var close = BX.findChild(BX(visualId), {className: "popup-window-close-icon"}, true, false);
		if(!!close)
			close.innerHTML = "<i class='fa fa-times'></i>";

		BX.PropsSet.popup.show();
	};

	window.JCCatalogSection.prototype.OpenFormPopup = function() {
		var target = BX.proxy_context,
			action = target.getAttribute("data-action"),
			visualId = action + "_" + this.visual.ID,
			elementId = this.product.id,
			elementName = this.product.name;
		BX.PopupForm =
		{						
			arParams: {}
		};
		BX.PopupForm.popup = BX.PopupWindowManager.create(visualId, null, {
			autoHide: true,
			offsetLeft: 0,
			offsetTop: 0,			
			overlay: {
				opacity: 100
			},
			draggable: false,
			closeByEsc: false,
			className: "pop-up forms full",
			closeIcon: { right : "-10px", top : "-10px"},			
			titleBar: true,
			content: "<div class='popup-window-wait'><i class='fa fa-spinner fa-pulse'></i></div>",			
			events: {
				onAfterPopupShow: function()
				{
					if(!BX(visualId + "_form")) {
						BX.ajax.post(
							BX.message("COMPARE_COMPONENT_TEMPLATE") + "/popup.php",
							{							
								sessid: BX.bitrix_sessid(),
								action: action,
								arParams: {
									ELEMENT_ID: elementId,
									ELEMENT_AREA_ID: visualId,
									ELEMENT_NAME: elementName
								}
							},
							BX.delegate(function(result)
							{
								this.setContent(result);
								var windowSize =  BX.GetWindowInnerSize(),
								windowScroll = BX.GetWindowScrollPos(),
								popupHeight = BX(visualId).offsetHeight;
								BX(visualId).style.top = windowSize.innerHeight/2 - popupHeight/2 + windowScroll.scrollTop + "px";
							},
							this)
						);
					}					
				}
			}			
		});
		
		var close = BX.findChild(BX(visualId), {className: "popup-window-close-icon"}, true, false);
		if(!!close)
			close.innerHTML = "<i class='fa fa-times'></i>";

		BX.PopupForm.popup.show();		
	};
	
	window.JCCatalogSection.prototype.Add2Basket = function() {
		var target = BX.proxy_context,
			form = BX.findParent(target, {"tag" : "form"}),
			formInputs = BX.findChildren(form, {"tag" : "input"}, true);
		
		if(!!formInputs && 0 < formInputs.length) {
			for(i = 0; i < formInputs.length; i++) {
				this.basketParams[formInputs[i].getAttribute("name")] = formInputs[i].value;
			}
		}
		
		BX.ajax.post(
			form.getAttribute("action"),			
			this.basketParams,			
			BX.delegate(function(result) {
				BX.ajax.post(
					BX.message("COMPARE_SITE_DIR") + "ajax/basket_line.php",
					"",
					BX.delegate(function(data) {
						refreshCartLine(data);
					}, this)
				);
				BX.ajax.post(
					BX.message("COMPARE_SITE_DIR") + "ajax/delay_line.php",
					"",
					BX.delegate(function(data) {
						var delayLine = BX.findChild(document.body, {className: "delay_line"}, true, false);
						if(!!delayLine)
							delayLine.innerHTML = data;						
					}, this)
				);
				BX.adjust(target, {
					props: {disabled: true},
					html: "<i class='fa fa-check'></i><span>" + BX.message("COMPARE_ADDITEMINCART_ADDED") + "</span>"
				});
				this.BasketResult();
			}, this)			
		);		
	};

	window.JCCatalogSection.prototype.BasketResult = function() {
		var close,
			strContent,
			strPictSrc,
			strPictWidth,
			strPictHeight,
			buttons = [];

		if(!!this.obPopupWin) {
			this.obPopupWin.close();
		}
		
		this.obPopupWin = BX.PopupWindowManager.create("addItemInCart", null, {
			autoHide: true,
			offsetLeft: 0,
			offsetTop: 0,
			overlay: {
				opacity: 100
			},
			draggable: false,
			closeByEsc: false,	
			className: "pop-up modal",
			closeIcon: {top: "-10px", right: "-10px"},
			titleBar: {content: BX.create("span", {html: BX.message("COMPARE_POPUP_WINDOW_TITLE")})}			
		});
		
		close = BX.findChild(BX("addItemInCart"), {className: "popup-window-close-icon"}, true, false);
		if(!!close)
			close.innerHTML = "<i class='fa fa-times'></i>";

		strPictSrc = this.product.pict.SRC;
		strPictWidth = this.product.pict.WIDTH;
		strPictHeight = this.product.pict.HEIGHT;
		
		strContent = "<div class='cont'><div class='item_image_cont'><div class='item_image_full'><img src='" + strPictSrc + "' width='" + strPictWidth + "' height='" + strPictHeight + "' alt='"+ this.product.name +"' /></div></div><div class='item_title'>" + this.product.name + "</div></div>";

		buttons = [			
			new BasketButton({				
				text: BX.message("COMPARE_POPUP_WINDOW_BTN_CLOSE"),
				name: "close",
				className: "btn_buy ppp close",
				events: {
					click: BX.delegate(this.obPopupWin.close, this.obPopupWin)
				}
			}),
			new BasketButton({				
				text: BX.message("COMPARE_POPUP_WINDOW_BTN_ORDER"),
				name: "order",
				className: "btn_buy popdef order",
				events: {
					click: BX.delegate(this.BasketRedirect, this)
				}
			})
		];
		
		this.obPopupWin.setContent(strContent);
		this.obPopupWin.setButtons(buttons);
		this.obPopupWin.show();	
	};

	window.JCCatalogSection.prototype.BasketRedirect = function() {
		location.href = BX.message("COMPARE_SITE_DIR") + "personal/cart/";
	};
})(window);