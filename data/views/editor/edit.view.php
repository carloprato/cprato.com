<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='margin: 0 auto;'>

			
			
			<textarea id="input">
				
					{{page_content}}
			</textarea>
			<script type="text/javascript">
			new TINY.editor.edit('editor',{
				id:'input',
				width:1000,
				height:400,
				cssclass:'te',
				controlclass:'tecontrol',
				rowclass:'teheader',
				dividerclass:'tedivider',
				controls:['bold','italic','underline','strikethrough','|','subscript','superscript','|',
						  'orderedlist','unorderedlist','|','outdent','indent','|','leftalign',
						  'centeralign','rightalign','blockjustify','|','unformat','|','undo','redo','n',
						  'font','size','style','|','image','hr','link','unlink','|','cut','copy','paste','print'],
				footer:true,
				fonts:['Verdana','Arial','Georgia','Trebuchet MS'],
				xhtml:true,
				cssfile:'/res/css/stylesheet.css',
				bodyid:'editor',
				footerclass:'tefooter',
				toggle:{text:'show source',activetext:'show wysiwyg',cssclass:'toggle'},
				resize:{cssclass:'resize'}
			});
			</script>


        </div>
    </div>
    <div class='fill'>
    </div>
</div>

