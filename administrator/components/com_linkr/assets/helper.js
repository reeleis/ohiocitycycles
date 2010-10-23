/*--- Linkr by Frank <francisamankrah@gmail.com> ---*/

// Inspired by com_media's popup-imagemanager.js
var LinkrHelper=
{
	init:function(loading,u,a,b){
		o=this.getURI(window.self.location.href);
		q=$H(this.getQueryObject(o.query));
		this.editor=decodeURIComponent(q.get('e_name'));
		this.loading=loading;
		this.url=u;
		this.missingText=a;
		this.missingURL=b;
	},
	section:function(){
		c=$('categories');
		c.innerHTML=this.loading;
		o=$('sectionList');
		sid=o[o.selectedIndex].value;
		var u=this.url+'categories&sid='+sid;
		var s=new Ajax(u,{
			method:'get',
			update:c
		});
		s.request();
	},
	category:function(){
		a=$('articles');
		a.innerHTML=this.loading;
		o=$('categoryList');
		cid=o[o.selectedIndex].value;
		var u=this.url+'articles&cid='+cid;
		var c=new Ajax(u,{
			method:'get',
			update:a
		});
		c.request();
	},
	search:function(){
		a=$('article');
		a.innerHTML=this.loading;
		q=$('search').value;
		var u=this.url+'search&q='+q;
		var s=new Ajax(u,{
			method:'get',
			update:a
		});
		s.request();
	},
	select:function(aid){
		a=$('article');
		a.innerHTML=this.loading;
		var u=this.url+'article&aid='+aid;
		var c=new Ajax(u,{
			method:'get',
			update:a,
			onComplete:function(){
				var slider=new Fx.Slide('settings',{duration: 500});
				slider.hide();
				$('toggle').addEvent('click',function(e){
					e=new Event(e);
					slider.toggle();
					e.stop();
				});
			}
		});
		c.request();
	},
	link:function(){
		t=$('linkText');
		u=$('linkURL');
		x=$('target');
		if(t.value.length==0){
			alert(this.missingText);
			t.focus();
		}else if(u.value.length==0){
			alert(this.missingURL);
			u.focus();
		}else{
			if(x.length==0)x='_self';
			var i=$('linkTitle');
			var c=$('linkClass');
			var l='<a href="'+u.value+'" target="'+x.value+'"';
			if(i.value.length!=0)l=l+' title="'+i.value+'"';
			if(c.value.length!=0)l=l+' class="'+c.value+'"';
			l=l+'>'+t.value+'</a>';
			window.parent.jInsertEditorText(l,this.editor);
			window.parent.document.getElementById('sbox-window').close();
		};
	},
	getQueryObject:function(q){
		var v=q.split(/[&;]/);
		var rs={};
		if (v.length)v.each(function(val){
			var k=val.split('=');
			if (k.length&&k.length==2)rs[encodeURIComponent(k[0])]=encodeURIComponent(k[1]);
		});
		return rs;
	},
	getURI:function(u){
		var b=u.match(/^(?:([^:\/?#.]+):)?(?:\/\/)?(([^:\/?#]*)(?::(\d*))?)((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[\?#]|$)))*\/?)?([^?#\/]*))?(?:\?([^#]*))?(?:#(.*))?/);
		return(b)?b.associate(['query']):null;
	}
};