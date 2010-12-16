(function ($) {

    $.fn.EnableMultiField = function (options) {

        options = $.extend({
            linkText: 'add more',
            linkClass: 'addMoreFields',
            enableRemove: true,
            removeLinkText: 'remove',
            removeLinkClass: 'removeFields',
            confirmOnRemove: true,
            confirmationMsgOnRemove: 'Are you sure you wish to remove selected field(s)?',
            addEventCallback: null,
            removeEventCallback: null,
            maxItemsAllowedToAdd: null,
            maxItemReachedCallback: null,
			namereplace:'[1]'
        },
        options);
		
        var length = $(this).size();
		options.namereplace = "["+length+"]";
		
        return this.each(function (i) {
            
            var self = $(this);
             
			var count = $("."+$(self).attr('class')).size();
			
            $(self).attr("TotalFieldsAdded", count);

            $(self).attr("maxCountReached", "false");
            fieldscnt =  count + 1 ;
            $(self).attr("FieldCount", fieldscnt);

            $(self).attr("uniqueId", options.linkClass + Math.random());

            $(self).find("." + options.linkClass).remove();

            $(self).find("." + options.removeLinkClass).remove();
			
          
			
			if(i!=0){
				 $(self).append(" <a href='#' class='" + options.removeLinkClass + "'>" + options.removeLinkText + "</a>");

				$(self).find("." + options.removeLinkClass).click(function () {
					return handleRemove($(this));
				});
			}
             if(i==(count-1))
            $(self).append(" <a href='#' class='" + options.linkClass + "'>" + options.linkText + "</a>");

            $(self).find("." + options.linkClass).click(function () {
                return handleAdd($(this));
            });
            var myClone = $(self).clone();

            function handleAdd(elem) {
                var totalCount = parseInt($(self).attr("TotalFieldsAdded"), 10);
                var fieldCount = parseInt($(self).attr("FieldCount"), 10);
			
                if (options.maxItemsAllowedToAdd === null || totalCount < options.maxItemsAllowedToAdd) {

                    var newElem = myClone.clone();
                    $(newElem).find("input ,select ,textarea ").each(function () {
																		  
                        $(this).val('');
						
                        if ($(this).attr("id")) {
                            var strid = $(this).attr("id");
                            var strname = "";

                           // if ($(this).attr("name")) {
                                strname = $(this).attr("name");
                            //}
                           
							
							var namereplace  = "["+ fieldCount +"]" ;
							
							$(this).attr("id", strid + "_" + fieldCount);
                            //$(this).attr("name", strname + "[" + fieldCount + "]");
							//$(this).attr('name',"data[Phone]["+ fieldCount +"][number]");
							//$(this).attr('name',"data[Phone]["+ fieldCount +"][phonetype_id]");
							$(this).attr("name", strname.replace(options.namereplace, namereplace));
							
							
                        }
                    });
					
					
                    totalCount++;
                    fieldCount++;

                    $(self).attr("TotalFieldsAdded", totalCount);
                    $(self).attr("FieldCount", fieldCount);

                    $(newElem).removeAttr("uniqueId");

                    if (options.enableRemove && $(self).attr("uniqueId") != $(elem).parent().attr("uniqueId")) {
                        if ($(elem).parent().find("." + options.removeLinkClass).length === 0 && $(elem).parent().find("." + options.linkClass).length > 1) {
                            $(elem).parent().append(" <a href='#' class='" + options.removeLinkClass + "'>" + options.removeLinkText + "</a>");
                        }
                        $(elem).parent().find("." + options.removeLinkClass).click(function () {
                            return handleRemove($(this));
                        });
                    }

                    $(newElem).attr("uniqueId", options.linkClass + Math.random());

                    $(elem).parent().after(newElem);

                    $(elem).parent().find("." + options.linkClass).remove();

                    $(newElem).find("." + options.linkClass).remove();
                    $(newElem).find("." + options.removeLinkClass).remove();

                    if (options.enableRemove) {
                        if ($(newElem).find("." + options.removeLinkClass).length === 0) {
                            $(newElem).append(" <a href='#' class='" + options.removeLinkClass + "'>" + options.removeLinkText + "</a>");
                        }
                        $(newElem).find("." + options.removeLinkClass).click(function () {
                            return handleRemove($(this));
                        });
                    }

                    $(self).attr("maxCountReached", "false");

                    $(newElem).append(" <a href='#' class='" + options.linkClass + "'>" + options.linkText + "</a>");

                    newElem.find("." + options.linkClass).click(function () {
                        return handleAdd($(this));
                    });

                    if (options.addEventCallback !== null) {
                        options.addEventCallback($(newElem), self);
                    }
                }

                if (options.maxItemsAllowedToAdd !== null && totalCount >= options.maxItemsAllowedToAdd) {
                    newElem.find("." + options.linkClass).hide();

                    if (options.maxItemReachedCallback !== null) {
                        options.maxItemReachedCallback($(newElem), self);
                    }
                }

                return false;
            }

            function handleRemove(elem) {
                var cnt = true;

                if (options.confirmOnRemove) {
                    cnt = confirm(options.confirmationMsgOnRemove);
                }
                if (cnt) {
                    var prevParent = $(elem).parent().prev();

                    var totalCount = parseInt($(self).attr("TotalFieldsAdded"), 10);
                    totalCount--;

                    $(self).attr("TotalFieldsAdded", totalCount);

                    if ($(elem).parent().find("." + options.linkClass).length > 0) {
                        if (options.enableRemove && $(self).attr("uniqueId") != $(prevParent).attr("uniqueId")) {
                            if ($(prevParent).find("." + options.removeLinkClass).length === 0 && $(elem).parent().find("." + options.linkClass).length > 1) {
                                $(prevParent).append(" <a href='#' class='" + options.removeLinkClass + "'>" + options.removeLinkText + "</a>");
                            }

                            $(prevParent).find("." + options.removeLinkClass).click(function () {
                                return handleRemove($(this));
                            });
                        }

                        $(prevParent).append(" <a href='#' class='" + options.linkClass + "'>" + options.linkText + "</a>");

                        prevParent.find("." + options.linkClass).click(function () {
                            return handleAdd($(this));
                        });
                    }

                    if (options.maxItemsAllowedToAdd !== null && totalCount < options.maxItemsAllowedToAdd) {
                        $(self).siblings().find("." + options.linkClass).show();
                    }

                    $(elem).parent().remove();

                    if (options.removeEventCallback !== null) {
                        options.removeEventCallback($(prevParent), self);
                    }
                }
                return false;
            }
        });

    };
})(DTjQuery);