/**
 * @version 0.9 $Id: settings.js 507 2008-01-03 15:48:34Z schlu $
 * @package Joomla
 * @subpackage EventList
 * @copyright (C) 2005 - 2008 Christoph Lukes
 * @license GNU/GPL, see LICENSE.php
 * EventList is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License 2
 * as published by the Free Software Foundation.

 * EventList is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with EventList; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 **/

function changeoldMode()
{
	if(document.getElementById) {
		mode = window.document.adminForm.oldevent.selectedIndex;
		switch (mode) {
			case 0:
				document.getElementById('old').style.display = 'none';
			break;
			default:
				document.getElementById('old').style.display = '';
		} // switch
	} // if
}

function changemailMode()
{
	if(document.getElementById) {
		mode = window.document.adminForm.mailinform.selectedIndex;
		switch (mode) {
			case 0:
				document.getElementById('mail1').style.display = 'none';
			break;
			default:
				document.getElementById('mail1').style.display = '';
		} // switch
	} // if
}

function changeintegrateMode()
{
	if(document.getElementById) {
		mode = window.document.adminForm.comunsolution.selectedIndex;
		switch (mode) {
			case 0:
				document.getElementById('integrate').style.display = 'none';
				break;
			default:
				document.getElementById('integrate').style.display = '';
		} // switch
	} // if
}

function changegdMode(mode)
{
	if(document.getElementById) {
		switch (mode) {
			case 0:
				document.getElementById('gd1').style.display = 'none';
				break;
			default:
				document.getElementById('gd1').style.display = '';
		} // switch
	} // if
}

function changemapMode()
{
	if(document.getElementById) {
		mode = window.document.adminForm.showmapserv.selectedIndex;
		switch (mode) {
			case 0:
				document.getElementById('map24').style.display = 'none';
				document.getElementById('gapikey').style.display = 'none';
				break;
			case 1:
				document.getElementById('map24').style.display = '';
				document.getElementById('gapikey').style.display = 'none';
				break;
			case 2:
				document.getElementById('map24').style.display = 'none';
				document.getElementById('gapikey').style.display = '';
				break;
			default:
				document.getElementById('map24').style.display = '';
				document.getElementById('gapikey').style.display = '';
		} // switch
	} // if
}

function changetitleMode(mode)
{
	if(document.getElementById) {
		switch (mode) {
			case 0:
				document.getElementById('title1').style.display = 'none';
				document.adminForm.titlewidth.value='';
				document.getElementById('title2').style.display = 'none';
				break;
			default:
				document.getElementById('title1').style.display = '';
				document.getElementById('title2').style.display = '';
		} // switch
	} // if
}

function changelocateMode(mode)
{
	if(document.getElementById) {
		switch (mode) {
			case 0:
				document.getElementById('locate1').style.display = 'none';
				document.adminForm.locationwidth.value='';
				document.getElementById('locate2').style.display = 'none';
				document.getElementById('locate3').style.display = 'none';
				break;
			default:
				document.getElementById('locate1').style.display = '';
				document.getElementById('locate2').style.display = '';
				document.getElementById('locate3').style.display = '';
		} // switch
	} // if
}

function changecityMode(mode)
{
	if(document.getElementById) {
		switch (mode) {
			case 0:
				document.getElementById('city1').style.display = 'none';
				document.adminForm.citywidth.value='';
				document.getElementById('city2').style.display = 'none';
				break;
			default:
				document.getElementById('city1').style.display = '';
				document.getElementById('city2').style.display = '';
		} // switch
	} // if
}

function changestateMode(mode)
{
	if(document.getElementById) {
		switch (mode) {
			case 0:
				document.getElementById('state1').style.display = 'none';
				document.adminForm.statewidth.value='';
				document.getElementById('state2').style.display = 'none';
				break;
			default:
				document.getElementById('state1').style.display = '';
				document.getElementById('state2').style.display = '';
		} // switch
	} // if
}

function changecatMode(mode)
{
	if(document.getElementById) {
		switch (mode) {
			case 0:
				document.getElementById('cat1').style.display = 'none';
				document.adminForm.catfrowidth.value='';
				document.getElementById('cat2').style.display = 'none';
				document.getElementById('cat3').style.display = 'none';
				break;
			default:
				document.getElementById('cat1').style.display = '';
				document.getElementById('cat2').style.display = '';
				document.getElementById('cat3').style.display = '';
		} // switch
	} // if
}

function changeregMode()
{
	if(document.getElementById) {
		mode = window.document.adminForm.showfroregistra.selectedIndex;
		switch (mode) {
			case 0:
				document.getElementById('froreg').style.display = 'none';
				break;
			default:
				document.getElementById('froreg').style.display = '';
		} // switch
	} // if
}

/**
 * Switcher behavior for configuration component
 *
 * @author		Johan Janssens <johan.janssens@joomla.org>
 * @package		Joomla.Extensions
 * @subpackage	Config
 * @since		1.5
 */
var JSwitcher = new Class({

initialize: function(toggler, element)
{
	var self = this;

	togglers = $ES('a', toggler);
	for (i=0; i < togglers.length; i++) {
		togglers[i].addEvent( 'click', function() { self.switchTo(this.getAttribute('id')); } );
	}

	//hide all
	elements = $ES('div', element);
	for (i=0; i < elements.length; i++) {
		this.hide(elements[i])
	}
},

switchTo: function(id)
{
	toggler = $(id);
	element = $('page-'+id);

	if(element)
	{
		//hide old element
		if(this.active) {
			this.hide(this.active);
		}

		//show new element
		this.show(element);

		toggler.addClass('active');
		if (this.test) {
			$(this.test).removeClass('active');
		}
		this.active = element;
		this.test = id;
	}
},

hide: function(element) {
	element.setStyle('display', 'none');
},

show: function (element) {
	element.setStyle('display', 'block');
	}
});

document.switcher = null;
Window.onDomReady(function(){
 	toggler = $('submenu')
  	element = $('elconfig-document')
  	if(element) {
  		document.switcher = new JSwitcher(toggler, element)
  	 	document.switcher.switchTo('basic');
  	}
});