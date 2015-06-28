<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='margin: 0 auto;'>
			<h2>Create New Page</h2>
			<form method='post' action='{{SITE_ROOT}}/{{lang}}/editor/add'>
			<input type='text' name='page_name'/>
				<textarea id="input" name='page_content'>
	    			<link href="/data/res/css/stylesheet.css" rel="stylesheet">

						<div class='evidence_container'>
						    <div class="row evidence">
						        <div class='col_4 evidence_paragraph'>
						            <h2>Column 1</h2>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac malesuada tortor. Donec at ante eu velit porta interdum vel vel nisi. Etiam nunc ante, feugiat vitae egestas id, egestas eu elit. Suspendisse potenti.
						        </div>
						        <div class='col_4 evidence_paragraph'>
						            <h2>Column 2</h2>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac malesuada tortor. Donec at ante eu velit porta interdum vel vel nisi. Etiam nunc ante, feugiat vitae egestas id, egestas eu elit. Suspendisse potenti.
						        </div>
						        <div class='col_4 evidence_paragraph'>
									<h2>Column 3</h2>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac malesuada tortor. Donec at ante eu velit porta interdum vel vel nisi. Etiam nunc ante, feugiat vitae egestas id, egestas eu elit. Suspendisse potenti. 
						        </div>
						    </div>
						    <div class='fill'></div>
						</div>
						<div class='content_container'>
						    <div class="row content">
						        <div class='col_8 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'>
												
						            <h2>Body</h2>
									
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac malesuada tortor. Donec at ante eu velit porta interdum vel vel nisi. Etiam nunc ante, feugiat vitae egestas id, egestas eu elit. Suspendisse potenti. Integer aliquam magna a scelerisque hendrerit. Vestibulum eu lacus mi. Nulla facilisi.								
									</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac malesuada tortor. Donec at ante eu velit porta interdum vel vel nisi. Etiam nunc ante, feugiat vitae egestas id, egestas eu elit. Suspendisse potenti. Integer aliquam magna a scelerisque hendrerit. Vestibulum eu lacus mi. Nulla facilisi.
									</p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac malesuada tortor. Donec at ante eu velit porta interdum vel vel nisi. Etiam nunc ante, feugiat vitae egestas id, egestas eu elit. Suspendisse potenti. Integer aliquam magna a scelerisque hendrerit. Vestibulum eu lacus mi. Nulla facilisi.
									</p>						 			          
						        </div>
						    </div>
						    <div class='fill'>
						    </div>
						</div>					
				</textarea>

				<script type="text/javascript">
				var editor = new TINY.editor.edit('editor',{
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
				<input type='submit' onClick="editor.post();" name='submit_button' value='{{translate:create_new_page}}'>
			</form>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>

