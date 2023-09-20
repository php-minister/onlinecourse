(function($){var MagicSuggest=function(element,options){var ms=this;var defaults={allowFreeEntries:true,cls:"",data:null,dataUrlParams:{},disabled:false,displayField:"name",editable:true,emptyText:function(){return cfg.editable?"Type or click here":"Click here"},emptyTextCls:"ms-empty-text",expanded:false,expandOnFocus:function(){return cfg.editable?false:true},groupBy:null,hideTrigger:false,highlight:true,id:function(){return"ms-ctn-"+$('div[id^="ms-ctn"]').length},infoMsgCls:"",inputCfg:{},invalidCls:"ms-ctn-invalid",matchCase:false,maxDropHeight:290,maxEntryLength:null,maxEntryRenderer:function(v){return"Please reduce your entry by "+v+" character"+(v>1?"s":"")},maxSuggestions:null,maxSelection:10,maxSelectionRenderer:function(v){return"You cannot choose more than "+v+" item"+(v>1?"s":"")},method:"POST",minChars:0,minCharsRenderer:function(v){return"Please type "+v+" more character"+(v>1?"s":"")},name:null,noSuggestionText:"No suggestions",preselectSingleSuggestion:true,renderer:null,required:false,resultAsString:false,selectionCls:"",selectionPosition:"inner",selectionRenderer:null,selectionStacked:false,sortDir:"asc",sortOrder:null,strictSuggest:false,style:"",typeDelay:400,useTabKey:false,useCommaKey:true,useZebraStyle:true,value:null,valueField:"id",width:function(){return $(this).width()}};var conf=$.extend({},options);var cfg=$.extend(true,{},defaults,conf);if($.isFunction(cfg.emptyText)){cfg.emptyText=cfg.emptyText.call(this)}if($.isFunction(cfg.expandOnFocus)){cfg.expandOnFocus=cfg.expandOnFocus.call(this)}if($.isFunction(cfg.id)){cfg.id=cfg.id.call(this)}this.addToSelection=function(items){if(!cfg.maxSelection||_selection.length<cfg.maxSelection){if(!$.isArray(items)){items=[items]}var valuechanged=false;$.each(items,function(index,json){if($.inArray(json[cfg.valueField],ms.getValue())===-1){_selection.push(json);valuechanged=true}});if(valuechanged===true){self._renderSelection();this.empty();$(this).trigger("selectionchange",[this,this.getSelectedItems()])}}};this.clear = function(isSilent){this.removeFromSelection(_selection.slice(0));};this.collapse=function(){if(cfg.expanded===true){this.combobox.detach();cfg.expanded=false;$(this).trigger("collapse",[this])}},this.disable=function(){this.container.addClass("ms-ctn-disabled");this.input.attr('disabled','disabled');cfg.disabled=true;};this.empty=function(){this.input.removeClass(cfg.emptyTextCls);this.input.val("")};this.enable=function(){this.container.removeClass("ms-ctn-disabled");this.input.removeAttr('disabled');cfg.disabled=false;};this.expand=function(){if(!cfg.expanded&&(this.input.val().length>=cfg.minChars||this.combobox.children().size()>0)){this.combobox.appendTo(this.container);self._processSuggestions();cfg.expanded=true;$(this).trigger("expand",[this])}};this.isDisabled=function(){return cfg.disabled};this.isValid=function(){return cfg.required===false||_selection.length>0};this.getDataUrlParams=function(){return cfg.dataUrlParams};this.getSelectedItems=function(){return _selection};this.getRawValue=function(){return ms.input.val()!==cfg.emptyText?ms.input.val():""};this.getValue=function(){return $.map(_selection,function(o){return o[cfg.valueField]})};this.removeFromSelection=function(items){if(!$.isArray(items)){items=[items]}var valuechanged=false;$.each(items,function(index,json){var i=$.inArray(json[cfg.valueField],ms.getValue());if(i>-1){_selection.splice(i,1);valuechanged=true}});if(valuechanged===true){self._renderSelection();$(this).trigger("selectionchange",[this,this.getSelectedItems()]);if(cfg.expandOnFocus){ms.expand()}if(cfg.expanded){self._processSuggestions()}}};this.setValue=function(data){var values=$.isArray(data)?data:[data],items=[];$.each(this.combobox.children(),function(index,suggestion){var obj=$(suggestion).data("json");if($.inArray(obj[cfg.valueField],values)>-1){items.push(obj)}});if(items.length>0){this.addToSelection(items)}};this.setDataUrlParams=function(params){cfg.dataUrlParams=$.extend({},params)};var _selection=[],_comboItemHeight=0,_timer,_hasFocus=false,_groups=null;var self={_displaySuggestions:function(data){ms.combobox.empty();var resHeight=0,nbGroups=0;if(_groups===null){self._renderComboItems(data);resHeight=_comboItemHeight*data.length}else{for(var grpName in _groups){nbGroups+=1;$("<div/>",{"class":"ms-res-group",html:grpName}).appendTo(ms.combobox);self._renderComboItems(_groups[grpName].items,true)}resHeight=_comboItemHeight*(data.length+nbGroups)}if(resHeight<ms.combobox.height()||resHeight<cfg.maxDropHeight){ms.combobox.height(resHeight)}else if(resHeight>=ms.combobox.height()&&resHeight>cfg.maxDropHeight){ms.combobox.height(cfg.maxDropHeight)}if(data.length===1&&cfg.preselectSingleSuggestion===true){ms.combobox.children().filter(":last").addClass("ms-res-item-active")}if(data.length===0&&ms.getRawValue()!==""){self._updateHelper(cfg.noSuggestionText);ms.collapse()}},_getEntriesFromStringArray:function(data){var json=[];$.each(data,function(index,s){var entry={};entry[cfg.displayField]=entry[cfg.valueField]=$.trim(s);json.push(entry)});return json},_highlightSuggestion:function(html){var q=ms.input.val()!==cfg.emptyText?ms.input.val():"";if(q.length===0){return html}if(cfg.matchCase===true){html=html.replace(new RegExp("("+q+")","g"),"<em>$1</em>")}else{html=html.replace(new RegExp("("+q+")","gi"),"<em>$1</em>")}return html},_moveSelectedRow:function(dir){if(!cfg.expanded){ms.expand()}var list,start,active,scrollPos;list=ms.combobox.find(".ms-res-item");if(dir==="down"){start=list.eq(0)}else{start=list.filter(":last")}active=ms.combobox.find(".ms-res-item-active:first");if(active.length>0){if(dir==="down"){start=active.nextAll(".ms-res-item").first();if(start.length===0){start=list.eq(0)}scrollPos=ms.combobox.scrollTop();ms.combobox.scrollTop(0);if(start[0].offsetTop+start.outerHeight()>ms.combobox.height()){ms.combobox.scrollTop(scrollPos+_comboItemHeight)}}else{start=active.prevAll(".ms-res-item").first();if(start.length===0){start=list.filter(":last");ms.combobox.scrollTop(_comboItemHeight*list.length)}if(start[0].offsetTop<ms.combobox.scrollTop()){ms.combobox.scrollTop(ms.combobox.scrollTop()-_comboItemHeight)}}}list.removeClass("ms-res-item-active");start.addClass("ms-res-item-active")},_processSuggestions:function(){var json=null;if(cfg.data!==null){if(typeof cfg.data==="string"&&cfg.data.indexOf(",")<0){$(ms).trigger("beforeload",[ms]);var params=$.extend({query:ms.input.val()},cfg.dataUrlParams);$.ajax({type:cfg.method,url:cfg.data,data:params,success:function(items){if(typeof items==="string"&&items.length>0){json=JSON.parse(items)}else if(items.results!==undefined){json=items.results}else if($.isArray(items)){json=items}else{json=[]}self._displaySuggestions(self._sortAndTrim(json));$(ms).trigger("load",[ms,json])},error:function(){throw"Could not reach server"}})}else if(typeof cfg.data==="string"&&cfg.data.indexOf(",")>-1){self._displaySuggestions(self._sortAndTrim(self._getEntriesFromStringArray(cfg.data.split(","))))}else{if(cfg.data.length>0&&typeof cfg.data[0]==="string"){self._displaySuggestions(self._sortAndTrim(self._getEntriesFromStringArray(cfg.data)))}else{self._displaySuggestions(self._sortAndTrim(cfg.data))}}}},_render:function(el){$(ms).trigger("beforerender",[ms]);var w=$.isFunction(cfg.width)?cfg.width.call(el):cfg.width;ms.container=$("<div/>",{id:cfg.id,"class":"ms-ctn "+cfg.cls+(cfg.disabled===true?" ms-ctn-disabled":"")+(cfg.editable===true?"":" ms-ctn-readonly"),style:"width: 99%"+cfg.style});ms.container.focus($.proxy(handlers._onFocus,this));ms.container.blur($.proxy(handlers._onBlur,this));ms.container.keydown($.proxy(handlers._onKeyDown,this));ms.container.keyup($.proxy(handlers._onKeyUp,this));ms.input=$("<input/>",$.extend({id:"ms-input-"+$('input[id^="ms-input"]').length,type:"text","class":"pull-left "+cfg.emptyTextCls+(cfg.editable===true?"":" ms-input-readonly"),value:cfg.emptyText,readonly:!cfg.editable,disabled:cfg.disabled,style:"width: "+(w-(cfg.hideTrigger?16:42))+"px;"},cfg.inputCfg));ms.input.focus($.proxy(handlers._onInputFocus,this));if(cfg.hideTrigger===false){ms.trigger=$("<div/>",{id:"ms-trigger-"+$('div[id^="ms-trigger"]').length,"class":"ms-trigger",html:'<div class="ms-trigger-ico"></div>'});ms.trigger.click($.proxy(handlers._onTriggerClick,this));ms.container.append(ms.trigger)}ms.combobox=$("<div/>",{id:"ms-res-ctn-"+$('div[id^="ms-res-ctn"]').length,"class":"ms-res-ctn ",style:"width: 100%; height: "+cfg.maxDropHeight+"px;"});ms.selectionContainer=$("<div/>",{id:"ms-sel-ctn-"+$('div[id^="ms-sel-ctn"]').length,"class":"ms-sel-ctn"});ms.selectionContainer.click($.proxy(handlers._onFocus,this));if(cfg.selectionPosition==="inner"){ms.selectionContainer.append(ms.input)}else{ms.container.append(ms.input)}ms.helper=$("<div/>",{"class":"ms-helper "+cfg.infoMsgCls});self._updateHelper();ms.container.append(ms.helper);$(el).replaceWith(ms.container);switch(cfg.selectionPosition){case"bottom":ms.selectionContainer.insertAfter(ms.container);if(cfg.selectionStacked===true){ms.selectionContainer.width(ms.container.width());ms.selectionContainer.addClass("ms-stacked")}break;case"right":ms.selectionContainer.insertAfter(ms.container);ms.container.css("float","left");break;default:ms.container.append(ms.selectionContainer);break}self._processSuggestions();if(cfg.value!==null){ms.setValue(cfg.value);self._renderSelection()}$(ms).trigger("afterrender",[ms]);$("body").click(function(e){if(ms.container.hasClass("ms-ctn-bootstrap-focus")&&ms.container.has(e.target).length===0&&e.target.className.indexOf("ms-res-item")<0&&e.target.className.indexOf("ms-close-btn")<0&&ms.container[0]!==e.target){handlers._onBlur()}});if(cfg.expanded===true){cfg.expanded=false;ms.expand()}},_renderComboItems:function(items,isGrouped){var ref=this;$.each(items,function(index,value){var displayed=cfg.renderer!==null?cfg.renderer.call(ref,value):value[cfg.displayField];var resultItemEl=$("<div/>",{"class":"ms-res-item "+(isGrouped?"ms-res-item-grouped ":"")+(index%2===1&&cfg.useZebraStyle===true?"ms-res-odd":""),html:cfg.highlight===true?self._highlightSuggestion(displayed):displayed}).data("json",value);resultItemEl.click($.proxy(handlers._onComboItemSelected,ref));resultItemEl.mouseover($.proxy(handlers._onComboItemMouseOver,ref));ms.combobox.append(resultItemEl)});_comboItemHeight=ms.combobox.find(".ms-res-item:first").outerHeight()},_renderSelection:function(){var ref=this,w=0,inputOffset=0,items=[],asText=cfg.resultAsString===true&&!_hasFocus;ms.selectionContainer.find(".ms-sel-item").remove();if(ms._valueContainer!==undefined){ms._valueContainer.remove()}$.each(_selection,function(index,value){var selectedItemEl,delItemEl,selectedItemHtml=cfg.selectionRenderer!==null?cfg.selectionRenderer.call(ref,value):value[cfg.displayField];if(asText===true){selectedItemEl=$("<div/>",{"class":"ms-sel-item ms-sel-text "+cfg.selectionCls,html:selectedItemHtml+(index===_selection.length-1?"":",")}).data("json",value)}else{selectedItemEl=$("<div/>",{"class":"ms-sel-item "+cfg.selectionCls,html:selectedItemHtml,title:selectedItemHtml.replace(/(<([^>]+)>)/gi,'')}).data("json",value);delItemEl=$("<span/>",{"class":"ms-close-btn"}).data("json",value).appendTo(selectedItemEl);delItemEl.click($.proxy(handlers._onTagTriggerClick,ref))}items.push(selectedItemEl)});ms.selectionContainer.prepend(items);ms._valueContainer=$("<input/>",{type:"hidden",'class':'required',name:cfg.name,id:cfg.name,value:JSON.stringify(ms.getValue())});ms._valueContainer.appendTo(ms.selectionContainer);if(cfg.selectionPosition==="inner"){ms.input.width(0);if(cfg.editable===true||_selection.length===0){inputOffset=ms.input.offset().left-ms.selectionContainer.offset().left;w=ms.container.width()-inputOffset-32-(cfg.hideTrigger===true?0:42);ms.input.width(w<100?100:w)}/*ms.container.height(ms.selectionContainer.height()+3)*/}if(_selection.length===cfg.maxSelection){self._updateHelper(cfg.maxSelectionRenderer.call(this,_selection.length))}else{ms.helper.hide()}},_selectItem:function(item){ms.addToSelection(item.data("json"));item.removeClass("ms-res-item-active");if(cfg.expandOnFocus===false||_selection.length===cfg.maxSelection){ms.collapse()}if(!_hasFocus){ms.input.focus()}else if(_hasFocus&&cfg.expandOnFocus){self._processSuggestions()}},_sortAndTrim:function(data){var q=ms.getRawValue(),filtered=[],newSuggestions=[],selectedValues=ms.getValue();if(q.length>0){$.each(data,function(index,obj){var name=obj[cfg.displayField];if(cfg.matchCase===true&&name.indexOf(q)>-1||cfg.matchCase===false&&name.toLowerCase().indexOf(q.toLowerCase())>-1){if(cfg.strictSuggest===false||name.toLowerCase().indexOf(q.toLowerCase())===0){filtered.push(obj)}}})}else{filtered=data}$.each(filtered,function(index,obj){if($.inArray(obj[cfg.valueField],selectedValues)===-1){newSuggestions.push(obj)}});if(cfg.sortOrder!==null){newSuggestions.sort(function(a,b){if(a[cfg.sortOrder]<b[cfg.sortOrder]){return cfg.sortDir==="asc"?-1:1}if(a[cfg.sortOrder]>b[cfg.sortOrder]){return cfg.sortDir==="asc"?1:-1}return 0})}if(cfg.maxSuggestions&&cfg.maxSuggestions>0){newSuggestions=newSuggestions.slice(0,cfg.maxSuggestions)}if(cfg.groupBy!==null){_groups={};$.each(newSuggestions,function(index,value){if(_groups[value[cfg.groupBy]]===undefined){_groups[value[cfg.groupBy]]={title:value[cfg.groupBy],items:[value]}}else{_groups[value[cfg.groupBy]].items.push(value)}})}return newSuggestions},_updateHelper:function(html){ms.helper.html(html);if(!ms.helper.is(":visible")){ms.helper.fadeIn()}}};var handlers={_onBlur:function(){ms.container.removeClass("ms-ctn-bootstrap-focus");ms.collapse();_hasFocus=false;if(ms.getRawValue()!==""&&cfg.allowFreeEntries===true){var obj={};obj[cfg.displayField]=obj[cfg.valueField]=ms.getRawValue();ms.addToSelection(obj)}self._renderSelection();if(ms.isValid()===false){ms.container.addClass("ms-ctn-invalid")}if(ms.input.val()===""&&_selection.length===0){ms.input.addClass(cfg.emptyTextCls);ms.input.val(cfg.emptyText)}else if(ms.input.val()!==""&&cfg.allowFreeEntries===false){ms.empty();self._updateHelper("")}if(ms.input.is(":focus")){$(ms).trigger("blur",[ms])}},_onComboItemMouseOver:function(e){ms.combobox.children().removeClass("ms-res-item-active");$(e.currentTarget).addClass("ms-res-item-active")},_onComboItemSelected:function(e){self._selectItem($(e.currentTarget))},_onFocus:function(){ms.input.focus()},_onInputFocus:function(){if(ms.isDisabled()===false&&!_hasFocus){_hasFocus=true;ms.container.addClass("ms-ctn-bootstrap-focus");ms.container.removeClass(cfg.invalidCls);if(ms.input.val()===cfg.emptyText){ms.empty()}var curLength=ms.getRawValue().length;if(cfg.expandOnFocus===true){ms.expand()}if(_selection.length===cfg.maxSelection){self._updateHelper(cfg.maxSelectionRenderer.call(this,_selection.length))}else if(curLength<cfg.minChars){self._updateHelper(cfg.minCharsRenderer.call(this,cfg.minChars-curLength))}self._renderSelection();$(ms).trigger("focus",[ms])}},_onKeyDown:function(e){var active=ms.combobox.find(".ms-res-item-active:first"),freeInput=ms.input.val()!==cfg.emptyText?ms.input.val():"";$(ms).trigger("keydown",[ms,e]);if(e.keyCode===9&&(cfg.useTabKey===false||cfg.useTabKey===true&&active.length===0&&ms.input.val().length===0)){handlers._onBlur();return}switch(e.keyCode){case 8:if(freeInput.length===0&&ms.getSelectedItems().length>0&&cfg.selectionPosition==="inner"){_selection.pop();self._renderSelection();$(ms).trigger("selectionchange",[ms,ms.getSelectedItems()]);ms.input.focus();e.preventDefault()}break;case 9:case 188:case 13:e.preventDefault();break;case 40:e.preventDefault();self._moveSelectedRow("down");break;case 38:e.preventDefault();self._moveSelectedRow("up");break;default:if(_selection.length===cfg.maxSelection){e.preventDefault()}break}},_onKeyUp:function(e){var freeInput=ms.getRawValue(),inputValid=$.trim(ms.input.val()).length>0&&ms.input.val()!==cfg.emptyText&&(!cfg.maxEntryLength||$.trim(ms.input.val()).length<=cfg.maxEntryLength),selected,obj={};$(ms).trigger("keyup",[ms,e]);clearTimeout(_timer);if(e.keyCode===27&&cfg.expanded){ms.combobox.height(0)}if(e.keyCode===9&&cfg.useTabKey===false||e.keyCode>13&&e.keyCode<32){return}switch(e.keyCode){case 40:case 38:e.preventDefault();break;case 13:case 9:case 188:if(e.keyCode!==188||cfg.useCommaKey===true){e.preventDefault();if(cfg.expanded===true){selected=ms.combobox.find(".ms-res-item-active:first");if(selected.length>0){self._selectItem(selected);return}}if(inputValid===true&&cfg.allowFreeEntries===true){obj[cfg.displayField]=obj[cfg.valueField]=freeInput;ms.addToSelection(obj);ms.collapse();ms.input.focus()}break}default:if(_selection.length===cfg.maxSelection){self._updateHelper(cfg.maxSelectionRenderer.call(this,_selection.length))}else{if(freeInput.length<cfg.minChars){self._updateHelper(cfg.minCharsRenderer.call(this,cfg.minChars-freeInput.length));if(cfg.expanded===true){ms.collapse()}}else if(cfg.maxEntryLength&&freeInput.length>cfg.maxEntryLength){self._updateHelper(cfg.maxEntryRenderer.call(this,freeInput.length-cfg.maxEntryLength));if(cfg.expanded===true){ms.collapse()}}else{ms.helper.hide();if(cfg.expanded===true){_timer=setTimeout(function(){self._processSuggestions()},cfg.typeDelay)}else if(cfg.minChars<=freeInput.length&&cfg.expanded===false){ms.expand()}}}break}},_onTagTriggerClick:function(e){ms.removeFromSelection($(e.currentTarget).data("json"))},_onTriggerClick:function(){if(ms.isDisabled()===false&&!(cfg.expandOnFocus===true&&_selection.length===cfg.maxSelection)){$(ms).trigger("triggerclick",[ms]);if(cfg.expanded===true){ms.collapse()}else{var curLength=ms.getRawValue().length;if(curLength>=cfg.minChars){ms.input.focus();ms.expand()}else{self._updateHelper(cfg.minCharsRenderer.call(this,cfg.minChars-curLength))}}}}};if(element!==null){self._render(element)}};$.fn.magicSuggest=function(options){var obj=$(this);if(obj.size()==1&&obj.data("magicSuggest")){return obj.data("magicSuggest")}obj.each(function(i){var cntr=$(this);if(cntr.data("magicSuggest"))return;if(this.nodeName.toLowerCase()==="select"){options.data=[];options.value=[];$.each(this.children,function(index,child){if(child.nodeName&&child.nodeName.toLowerCase()==="option"){options.data.push({id:child.value,name:child.text});if(child.selected)options.value.push(child.value)}})}var field=new MagicSuggest(this,options);cntr.data("magicSuggest",field)});if(obj.size()==1){return obj.data("magicSuggest")}return obj}})(jQuery);