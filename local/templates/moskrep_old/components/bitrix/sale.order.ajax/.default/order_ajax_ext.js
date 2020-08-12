(function () {
    'use strict'; 
 
    var initParent = BX.Sale.OrderAjaxComponent.init,
        getBlockFooterParent = BX.Sale.OrderAjaxComponent.getBlockFooter,
        editOrderParent = BX.Sale.OrderAjaxComponent.editOrder
        ;
 
    BX.namespace('BX.Sale.OrderAjaxComponentExt');    
 
    BX.Sale.OrderAjaxComponentExt = BX.Sale.OrderAjaxComponent;
 
    BX.Sale.OrderAjaxComponentExt.init = function (parameters) {
        initParent.apply(this, arguments);
 
        var editSteps = this.orderBlockNode.querySelectorAll('.bx-soa-editstep'), i;
        for (i in editSteps) {
            if (editSteps.hasOwnProperty(i)) {
                BX.remove(editSteps[i]);
            }
        }
 
    };
 
    BX.Sale.OrderAjaxComponentExt.getBlockFooter = function (node) {
        var parentNodeSection = BX.findParent(node, {className: 'bx-soa-section'});
 
        getBlockFooterParent.apply(this, arguments);
 
        if (/bx-soa-auth|bx-soa-properties|bx-soa-basket/.test(parentNodeSection.id)) {
            BX.remove(parentNodeSection.querySelector('.pull-left'));
            BX.remove(parentNodeSection.querySelector('.pull-right'));
        }
 
    };
 
 
    BX.Sale.OrderAjaxComponentExt.editOrder = function (section) {
 
        editOrderParent.apply(this, arguments);
 
        var sections = this.orderBlockNode.querySelectorAll('.bx-soa-section.bx-active'), i;
 
        for (i in sections) {
            if (sections.hasOwnProperty(i)) {
                if (!(/bx-soa-auth|bx-soa-properties|bx-soa-basket/.test(sections[i].id))) {
                    sections[i].classList.add('bx-soa-section-hide');
                }
            }
        }
 
        
        this.show(BX('bx-soa-delivery'));
        
        this.show(BX('bx-soa-paysystem'));
        
        this.show(BX('bx-soa-properties'));
       
        
        
        this.editActiveBasketBlock(true);
 
        this.alignBasketColumns();
 
        if (!this.result.IS_AUTHORIZED) {
            this.switchOrderSaveButtons(true);
        }
        
                    var labels = BX.findChildren(BX('bx-soa-properties'), {tag: 'LABEL'}, true);
                    var conteiner = BX.findChildren(BX('bx-soa-properties'), {tag: 'DIV', className: 'soa-property-container'}, true); 
                    var inputs = BX.findChildren(BX('bx-soa-properties'), { tag: 'INPUT', className: 'bx-ios-fix' }, true);
                    var textarea = BX.findChildren(BX('bx-soa-properties'), {tag: 'TEXTAREA', className: 'bx-ios-fix'}, true);
                    var conteiner_gl = BX.findChildren(BX('bx-soa-properties'), {tag: 'DIV', className: 'form-group bx-soa-customer-field'}, true);
                   
                    var location_cont = BX.findChildren(BX('bx-soa-region'), {tag: 'DIV', className: 'bx-soa-location-input-container'});
                    var soa = BX.findChildren(BX('bx-soa-delivery'), {tag: 'DIV', className: 'bx-soa-section-content'}, true);
                    
                    BX.ready(function(){          
                        for (i = 0; i < inputs.length; i++)
			{
				
                                BX.append(inputs[i],labels[i]);
                                BX.addClass(inputs[i], 'form__input');
                                BX.removeClass(inputs[i], 'form-control');
                                
                                
                                BX.remove(conteiner[i]);
                         
			}
                        var area = 0;
                        for (i = inputs.length; i < labels.length; i++)
			{
				
                                BX.addClass(labels[i], 'feedback-form__label');
                                BX.append(textarea[area],labels[i]);
                                BX.addClass(textarea[area], 'form__textarea');
                                BX.removeClass(textarea[area], 'form-control');
                                area++;
                                
                         
			}
                       
                       
                        //BX.append(location_cont[0],soa[1]);
                    });
         
       
    };
   
    
 
 
    BX.Sale.OrderAjaxComponentExt.initFirstSection = function (parameters) {
 
    };
 

})();