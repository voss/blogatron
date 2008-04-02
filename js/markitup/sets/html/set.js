// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2007 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// Html tags
// http://en.wikipedia.org/wiki/html
// ----------------------------------------------------------------------------
// Basic set. Feel free to add more tags
// ----------------------------------------------------------------------------
mySettings = {
	onShiftEnter:	{keepDefault:false, replaceWith:'<br />\n'},
	onCtrlEnter:	{keepDefault:false, openWith:'\n<p>', closeWith:'</p>\n'},
	onTab:			{keepDefault:false, openWith:'	 '},
	markupSet:  [	 
		{name:'Heading 1', key:'1', openWith:'<h1(!( class="[![Class]!]")!)>', closeWith:'</h1>', placeHolder:'Your title here...' },
		{name:'Heading 2', key:'2', openWith:'<h2(!( class="[![Class]!]")!)>', closeWith:'</h2>', placeHolder:'Your title here...' },
		{name:'Heading 3', key:'3', openWith:'<h3(!( class="[![Class]!]")!)>', closeWith:'</h3>', placeHolder:'Your title here...' },
		{name:'Heading 4', key:'4', openWith:'<h4(!( class="[![Class]!]")!)>', closeWith:'</h4>', placeHolder:'Your title here...' },
		{name:'Heading 5', key:'5', openWith:'<h5(!( class="[![Class]!]")!)>', closeWith:'</h5>', placeHolder:'Your title here...' },
		{name:'Heading 6', key:'6', openWith:'<h6(!( class="[![Class]!]")!)>', closeWith:'</h6>', placeHolder:'Your title here...' },
		{name:'Paragraph', openWith:'<p(!( class="[![Class]!]")!)>', closeWith:'</p>'  }, 
		{separator:'---------------' },
		{name:'Bold', key:'B', openWith:'<strong>', closeWith:'</strong>' },
		{name:'Italic', key:'I', openWith:'<em>', closeWith:'</em>'  },
		{name:'Stroke through', key:'S', openWith:'<del>', closeWith:'</del>' },
		{separator:'---------------' },
		{name:'Ul', openWith:'<ul>\n', closeWith:'</ul>\n' },
		{name:'Ol', openWith:'<ol>\n', closeWith:'</ol>\n' },
		{name:'Li', openWith:'<li>', closeWith:'</li>' },
		{separator:'---------------' },
		{name:'Picture', key:'P', replaceWith:'<img src="[![Source:!:http://]!]" alt="[![Alternative text]!]" />' },
		{name:'Link', key:'L', openWith:'<a href="[![Link:!:http://]!]"(!( title="[![Title]!]")!)>', closeWith:'</a>', placeHolder:'Your text to link...' },
		{separator:'---------------' },
		{name:'Clean', replaceWith:function(h) { return h.selection.replace(/<(.*?)>/g, "") } },				
		{name:'Preview', call:'preview', className:'preview' },
		{separator:'---------------' },
		{name:'BlockQuote', key:'C', openWith:'<blockquote>', closeWith:'</blockquote>' },
		{	name:'Encode Html special chars',
			className:"encodechars", 
			replaceWith:function(h) { 
							c = document.createElement('div');
							c.appendChild(document.createTextNode(h.selection));
							return c.innerHTML; 
						}
		},
		{	name:'Colors', className:'palette', dropMenu: [
				{name:'Yellow',	replaceWith:'#FCE94F',	className:"col1-1" },
				{name:'Yellow',	replaceWith:'#EDD400', 	className:"col1-2" },
				{name:'Yellow', replaceWith:'#C4A000', 	className:"col1-3" },
				
				{name:'Orange', replaceWith:'#FCAF3E', 	className:"col2-1" },
				{name:'Orange', replaceWith:'#F57900', 	className:"col2-2" },
				{name:'Orange', replaceWith:'#CE5C00', 	className:"col2-3" },
				
				{name:'Brown', 	replaceWith:'#E9B96E', 	className:"col3-1" },
				{name:'Brown', 	replaceWith:'#C17D11', 	className:"col3-2" },
				{name:'Brown',	replaceWith:'#8F5902', 	className:"col3-3" },
				
				{name:'Green', 	replaceWith:'#8AE234', 	className:"col4-1" },
				{name:'Green', 	replaceWith:'#73D216', 	className:"col4-2" },
				{name:'Green',	replaceWith:'#4E9A06', 	className:"col4-3" },
				
				{name:'Blue', 	replaceWith:'#729FCF', 	className:"col5-1" },
				{name:'Blue', 	replaceWith:'#3465A4', 	className:"col5-2" },
				{name:'Blue',	replaceWith:'#204A87', 	className:"col5-3" },
	
				{name:'Purple', replaceWith:'#AD7FA8', 	className:"col6-1" },
				{name:'Purple', replaceWith:'#75507B', 	className:"col6-2" },
				{name:'Purple',	replaceWith:'#5C3566', 	className:"col6-3" },
				
				{name:'Red', 	replaceWith:'#EF2929', 	className:"col7-1" },
				{name:'Red', 	replaceWith:'#CC0000', 	className:"col7-2" },
				{name:'Red',	replaceWith:'#A40000', 	className:"col7-3" },
				
				{name:'Gray', 	replaceWith:'#FFFFFF', 	className:"col8-1" },
				{name:'Gray', 	replaceWith:'#D3D7CF', 	className:"col8-2" },
				{name:'Gray',	replaceWith:'#BABDB6', 	className:"col8-3" },
				
				{name:'Gray', 	replaceWith:'#888A85', 	className:"col9-1" },
				{name:'Gray', 	replaceWith:'#555753', 	className:"col9-2" },
				{name:'Gray',	replaceWith:'#000000', 	className:"col9-3" }
			]
		}


	]
}