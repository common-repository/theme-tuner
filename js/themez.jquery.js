jQuery.fn.tagName = function() {
    return this.get(0).tagName;
}

var themez = {
	t : false,
	curdiv: null,
	curattr: null,
	sidebar: null,
	css: {'color':{'name':'Color','type':'color'},'background-color':{'name':'Bk Color','type':'color'},'font-family':{'name':'Font'}},
	tags: ['div','h1','h2','h3','h4','h5','h6','h7'],
		
	init : function() {
		that=this;
		for (var i in this.tags) {
			jQuery(this.tags[i]).each(function(i,e) {
				div=jQuery(e);
			
				if (div.attr('id') != 'tt-sidebar') {
					div.bind('click',this,function(e) {
						that.edit(jQuery(e.data));
						return false; //stops event bubbling
					});
				} else {
					div.bind('click',this,function(e) {
					return false; //stops event bubbling
					});
				}
			});
		}
		this.sidebar();
	},

	sidebar: function() {
		that=this;
		var content='<form id="tt-sidebar-form" action="#">';
		content+='<p>Tag:</p> <input type="input" name="tt-tag" id="tt-tag" readonly/>';
		content+='<br /><p>ID:</p> <input name="tt-id"  id="tt-id" />';
		content+='<br /><p>Class:</p> <input id="tt-class" name="tt-class" />';
		for (var i in this.css) {
			content+='<br />';
			content+='<p>'+this.css[i].name+':</p> <input class="'+this.css[i].type+'" id="tt-'+i+'" name="tt-'+i+'" value="'+this.css[i].name+'"/>';
		}
		content+='<br /><input id="tt-sidebar-save" type="submit" value="Save">';
		content+='</form>';
		var e=jQuery('#tt-sidebar');
		this.sidebar=e;
		e.css({'z-index':999});
		e.html(content);

		for (var i in this.css) {
			if (this.css[i].type=='color') {
				jQuery('#tt-'+i).bind('change',{'i':i},function(e) {
					var color=jQuery(this).css('background-color');
					that.curdiv.css(e.data.i,color);
				});
			}
		}
		
		jQuery('#tt-sidebar-save').bind('click',function() {
			that.saveTag();
		});
	},
	
	saveTag: function() {
		form = jQuery('#tt-sidebar-form');
		new jQuery.ajax({
			url : ttURL+'?tt-page=savetag',
			type : "post",
			data : form.serialize(true),
			success : function(request) {
				//alert('ok saved');
			}
		});

	},
	
	edit : function(e) {
		if (this.curdiv != null) {
			this.curdiv.css('background-color',this.curclr);
		}
		id=e.attr('id');
		cls=e.attr('class');
		this.curdiv=e;
		this.curclr=e.css('background-color');
		var tag=e.tagName().toLowerCase();
		jQuery('#tt-tag').attr('value',tag);
		jQuery('#tt-id').attr('value',id);
		jQuery('#tt-class').attr('value',cls);
		for (var i in this.css) {
			if (this.css[i].type=='color') jQuery('#tt-'+i).css(i,e.css(i));
			else jQuery('#tt-'+i).attr('value',e.css(i));
			//if (this.attributes[i].type=='color') 
		}
		e.css('background-color','green');
		this.t=true;
	}
};
jQuery(document).ready(function() {
	
	themez.init();
});

