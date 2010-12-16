(function() {

	

	function stripHtml(value) {

		// remove html tags and space chars

		return value.replace(/<.[^<>]*?>/g, ' ').replace(/&nbsp;|&#160;/gi, ' ')

		// remove numbers and punctuation

		.replace(/[0-9.(),;:!?%#$'"_+=\/-]*/g,'');

	}

	DTjQuery.validator.addMethod("maxWords", function(value, element, params) { 

	    return this.optional(element) || stripHtml(value).match(/\b\w+\b/g).length < params; 

	}, DTjQuery.validator.format("Please enter {0} words or less.")); 

	 

	DTjQuery.validator.addMethod("minWords", function(value, element, params) { 

	    return this.optional(element) || stripHtml(value).match(/\b\w+\b/g).length >= params; 

	}, DTjQuery.validator.format("Please enter at least {0} words.")); 

	 

	DTjQuery.validator.addMethod("rangeWords", function(value, element, params) { 

	    return this.optional(element) || stripHtml(value).match(/\b\w+\b/g).length >= params[0] && value.match(/bw+b/g).length < params[1]; 

	}, DTjQuery.validator.format("Please enter between {0} and {1} words."));



})();



DTjQuery.validator.addMethod("letterswithbasicpunc", function(value, element) {

	return this.optional(element) || /^[a-z-.,()'\"\s]+$/i.test(value);

}, "Letters or punctuation only please");  



DTjQuery.validator.addMethod("alphanumeric", function(value, element) {

	return this.optional(element) || /^\w+$/i.test(value);

}, "Letters, numbers, spaces or underscores only please");  





DTjQuery.validator.addMethod("lettersonly", function(value, element) {

	return this.optional(element) || /^[a-z]+$/i.test(value);

}, "Letters only please"); 

DTjQuery.validator.addMethod("fieldtag", function(value, element) {
    value = value.toUpperCase();
	element.value = element.value.toUpperCase();
	
	return this.optional(element) || /^[A-Z_0-9]+$/.test(value);

}, " "); 


DTjQuery.validator.addMethod("nowhitespace", function(value, element) {

	return this.optional(element) || /^\S+$/i.test(value);

}, "No white space please"); 



DTjQuery.validator.addMethod("ziprange", function(value, element) {

	return this.optional(element) || /^90[2-5]\d\{2}-\d{4}$/.test(value);

}, "Your ZIP-code must be in the range 902xx-xxxx to 905-xx-xxxx");



DTjQuery.validator.addMethod("integer", function(value, element) {

	return this.optional(element) || /^-?\d+$/.test(value);

}, "A positive or negative non-decimal number please");



/**

* Return true, if the value is a valid vehicle identification number (VIN).

*

* Works with all kind of text inputs.

*

* @example <input type="text" size="20" name="VehicleID" class="{required:true,vinUS:true}" />

* @desc Declares a required input element whose value must be a valid vehicle identification number.

*

* @name jQuery.validator.methods.vinUS

* @type Boolean

* @cat Plugins/Validate/Methods

*/ 

DTjQuery.validator.addMethod(

	"vinUS",

	function(v){

		if (v.length != 17)

			return false;

		var i, n, d, f, cd, cdv;

		var LL    = ["A","B","C","D","E","F","G","H","J","K","L","M","N","P","R","S","T","U","V","W","X","Y","Z"];

		var VL    = [1,2,3,4,5,6,7,8,1,2,3,4,5,7,9,2,3,4,5,6,7,8,9];

		var FL    = [8,7,6,5,4,3,2,10,0,9,8,7,6,5,4,3,2];

		var rs    = 0;

		for(i = 0; i < 17; i++){

		    f = FL[i];

		    d = v.slice(i,i+1);

		    if(i == 8){

		        cdv = d;

		    }

		    if(!isNaN(d)){

		        d *= f;

		    }

		    else{

		        for(n = 0; n < LL.length; n++){

		            if(d.toUpperCase() === LL[n]){

		                d = VL[n];

		                d *= f;

		                if(isNaN(cdv) && n == 8){

		                    cdv = LL[n];

		                }

		                break;

		            }

		        }

		    }

		    rs += d;

		}

		cd = rs % 11;

		if(cd == 10){cd = "X";}

		if(cd == cdv){return true;}

		return false; 

	},

	"The specified vehicle identification number (VIN) is invalid."

);



/**

  * Return true, if the value is a valid date, also making this formal check dd/mm/yyyy.

  *

  * @example jQuery.validator.methods.date("01/01/1900")

  * @result true

  *

  * @example jQuery.validator.methods.date("01/13/1990")

  * @result false

  *

  * @example jQuery.validator.methods.date("01.01.1900")

  * @result false

  *

  * @example <input name="pippo" class="{dateITA:true}" />

  * @desc Declares an optional input element whose value must be a valid date.

  *

  * @name jQuery.validator.methods.dateITA

  * @type Boolean

  * @cat Plugins/Validate/Methods

  */

DTjQuery.validator.addMethod(

	"dateITA",

	function(value, element) {

		var check = false;

		var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

		if( re.test(value)){

			var adata = value.split('/');

			var gg = parseInt(adata[0],10);

			var mm = parseInt(adata[1],10);

			var aaaa = parseInt(adata[2],10);

			var xdata = new Date(aaaa,mm-1,gg);

			if ( ( xdata.getFullYear() == aaaa ) && ( xdata.getMonth () == mm - 1 ) && ( xdata.getDate() == gg ) )

				check = true;

			else

				check = false;

		} else

			check = false;

		return this.optional(element) || check;

	}, 

	"Please enter a correct date"

);



DTjQuery.validator.addMethod(

	"dateDT",

	function(value, element) {

		var check = false;

		var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

		var field_id = DTjQuery(element).attr("id");

		eval("re = dateregex"+field_id+";");

		

	

		

		if( re.test(value)){

			var adata = value.split('/');

			var gg = parseInt(adata[0],10);

			var mm = parseInt(adata[1],10);

			var aaaa = parseInt(adata[2],10);

			var xdata = new Date(aaaa,mm-1,gg);

			if ( ( xdata.getFullYear() == aaaa ) && ( xdata.getMonth () == mm - 1 ) && ( xdata.getDate() == gg ) )

				check = true;

			else

				check = true;

		} else

			check = false;

		return this.optional(element) || check;

	}, 

	"Please enter a correct date"

);



DTjQuery.validator.addMethod("dateNL", function(value, element) {

		return this.optional(element) || /^\d\d?[\.\/-]\d\d?[\.\/-]\d\d\d?\d?$/.test(value);

	}, "Vul hier een geldige datum in."

);



DTjQuery.validator.addMethod("time", function(value, element) {

		return this.optional(element) || /^([01][0-9])|(2[0123]):([0-5])([0-9])$/.test(value);

	}, "Please enter a valid time, between 00:00 and 23:59"

);



/**

 * matches US phone number format 

 * 

 * where the area code may not start with 1 and the prefix may not start with 1 

 * allows '-' or ' ' as a separator and allows parens around area code 

 * some people may want to put a '1' in front of their number 

 * 

 * 1(212)-999-2345

 * or

 * 212 999 2344

 * or

 * 212-999-0983

 * 

 * but not

 * 111-123-5434

 * and not

 * 212 123 4567

 */

DTjQuery.validator.addMethod("phoneUS", function(phone_number, element) {

    phone_number = phone_number.replace(/\s+/g, ""); 

	return this.optional(element) || phone_number.length > 9 &&

		phone_number.match(/^(1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);

}, "Please specify a valid phone number");



DTjQuery.validator.addMethod('phoneUK', function(phone_number, element) {

return this.optional(element) || phone_number.length > 9 &&

phone_number.match(/^(\(?(0|\+44)[1-9]{1}\d{1,4}?\)?\s?\d{3,4}\s?\d{3,4})$/);

}, 'Please specify a valid phone number');



DTjQuery.validator.addMethod('mobileUK', function(phone_number, element) {

return this.optional(element) || phone_number.length > 9 &&

phone_number.match(/^((0|\+44)7(5|6|7|8|9){1}\d{2}\s?\d{6})$/);

}, 'Please specify a valid mobile number');



// TODO check if value starts with <, otherwise don't try stripping anything

DTjQuery.validator.addMethod("strippedminlength", function(value, element, param) {

	return DTjQuery(value).text().length >= param;

}, DTjQuery.validator.format("Please enter at least {0} characters"));



// same as email, but TLD is optional

DTjQuery.validator.addMethod("email2", function(value, element, param) {

	return this.optional(element) || /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)*(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(value); 

}, DTjQuery.validator.messages.email);



// same as url, but TLD is optional

DTjQuery.validator.addMethod("url2", function(value, element, param) {

	return this.optional(element) || /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)*(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value); 

}, DTjQuery.validator.messages.url);



// NOTICE: Modified version of Castle.Components.Validator.CreditCardValidator

// Redistributed under the the Apache License 2.0 at http://www.apache.org/licenses/LICENSE-2.0

// Valid Types: mastercard, visa, amex, dinersclub, enroute, discover, jcb, unknown, all (overrides all other settings)

DTjQuery.validator.addMethod("creditcardtypes", function(value, element, param) {



	if (/[^0-9-]+/.test(value)) 

		return false;

	

	value = value.replace(/\D/g, "");

	

	var validTypes = 0x0000;

	

	if (param.mastercard) 

		validTypes |= 0x0001;

	if (param.visa) 

		validTypes |= 0x0002;

	if (param.amex) 

		validTypes |= 0x0004;

	if (param.dinersclub) 

		validTypes |= 0x0008;

	if (param.enroute) 

		validTypes |= 0x0010;

	if (param.discover) 

		validTypes |= 0x0020;

	if (param.jcb) 

		validTypes |= 0x0040;

	if (param.unknown) 

		validTypes |= 0x0080;

	if (param.all) 

		validTypes = 0x0001 | 0x0002 | 0x0004 | 0x0008 | 0x0010 | 0x0020 | 0x0040 | 0x0080;

	

	if (validTypes & 0x0001 && /^(51|52|53|54|55)/.test(value)) { //mastercard

		return value.length == 16;

	}

	if (validTypes & 0x0002 && /^(4)/.test(value)) { //visa

		return value.length == 16;

	}

	if (validTypes & 0x0004 && /^(34|37)/.test(value)) { //amex

		return value.length == 15;

	}

	if (validTypes & 0x0008 && /^(300|301|302|303|304|305|36|38)/.test(value)) { //dinersclub

		return value.length == 14;

	}

	if (validTypes & 0x0010 && /^(2014|2149)/.test(value)) { //enroute

		return value.length == 15;

	}

	if (validTypes & 0x0020 && /^(6011)/.test(value)) { //discover

		return value.length == 16;

	}

	if (validTypes & 0x0040 && /^(3)/.test(value)) { //jcb

		return value.length == 16;

	}

	if (validTypes & 0x0040 && /^(2131|1800)/.test(value)) { //jcb

		return value.length == 15;

	}

	if (validTypes & 0x0080) { //unknown

		return true;

	}

	return false;

}, "Please enter a valid credit card number.");

DTjQuery.validator.addMethod("lessthen", function(value, element, param) {
	
	var target = DTjQuery(param);
	if(value == "" || value== 0 || target.val() == "" || target.val() == 0){
		 return true;
		}
	return value <= target.val();
})

DTjQuery.validator.addMethod("datelessthen", function(value, element, param) {
	var startdate = DTjQuery("#dtstart").val();
	var format = DTjQuery('#dataeventtimeformat').val();
	var starttime = DTjQuery("#dtstarttime").val();
	var enddate = DTjQuery("#dtend").val();
	var endtime = DTjQuery("#dtendtime").val();
	if(startdate == "" || endtime == ""){
		return false ;
	}
	if(format==2){
	  var starttimeparts = starttime.split(":");
	  var starthours =  starttimeparts[0] ;
	  var startmins = starttimeparts[1] ;
	  var endtimeparts = endtime.split(":");
	  var endhours =  endtimeparts[0] ;
	  var endmins = endtimeparts[1] ;
	}else{
	   
	  var startparts = starttime.split(" ");
	  var starttimeparts = startparts[0];
	  var starttimeparts = starttimeparts.split(":");
	  var starthours   = starttimeparts[0] ;
	  var startmins = starttimeparts[1] ;
	
	  var endparts = endtime.split(" ");
	  var endtimeparts = endparts[0];
	  var endtimeparts = endtimeparts.split(":");
	  var endhours   = endtimeparts[0] ;
	  var endmins = endtimeparts[1] ;
	
	  
	  if(startparts[1] != 'AM'){
		  if(starthours=="12"){
		  //starthours =  "00" ;
		  }else{ 
		   starthours  = parseFloat(starthours) + 12 ;
		   starthours = starthours+"";
		  
		  }
	  }
	 
	  if(endparts[1] != 'AM'){
	       if(endhours=="12"){
			//endhours ="00" ;
		  }else{
			  
			 endhours = parseFloat(endhours) +  12 ;
			 endhours = endhours+"";
		  }
	  }

	   if(startparts[1] == 'AM'){
		  if(starthours=="12"){
		  starthours =  "00" ;
		  }
	  }
	
	  if(endparts[1] == 'AM'){
	       if(endhours=="12"){
			endhours ="00" ;
		  
		  }
	  }


	
	}
	
	var startdatetime = startdate.replace(/-/g,"")+starthours+startmins+"00";
	var enddatetime = enddate.replace(/-/g,"")+endhours+endmins+"00";
	

	var start =  new Date(startdatetime.replace(
    /^(\d{4})(\d\d)(\d\d)(\d\d)(\d\d)(\d\d)$/,
    '$2/$3/$1 $4:$5:$6'
));
	var end =  new Date(enddatetime.replace(
    /^(\d{4})(\d\d)(\d\d)(\d\d)(\d\d)(\d\d)$/,
    '$2/$3/$1 $4:$5:$6'
));
	/*console.log(start);
	console.log(end);
	start.setHours(starthours);
	end.setHours(endhours);
	start.setMinutes(startmins );
	end.setMinutes(endmins );
	console.log(start);
	console.log(end);*/
	return (start<end);
	
	
});
DTjQuery.validator.addMethod("uniquevalue", function(value, element) {
    
	var temp = [] ;
	var count = 0 ;
	DTjQuery("form input[name='"+element.name+"']").each(function(){
	   
	   count++ ;
	   temp.push(DTjQuery(this).val());
	   
	})
	
	return (temp.unique().length == count) ;
	

}, "Duplicate values ");  
Array.prototype.unique = function () {
	var r = new Array();
	o:for(var i = 0, n = this.length; i < n; i++)
	{
		for(var x = 0, y = r.length; x < y; x++)
		{
			if(r[x]==this[i])
			{
				continue o;
			}
		}
		r[r.length] = this[i];
	}
	return r;
}

